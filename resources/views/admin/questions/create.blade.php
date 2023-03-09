<x-admin.layout>
    <x-admin.hero title="Create Questions" button="Back" href="{{ route('admin.questions') }}" />
    <div class="card-content">
        <form method="post" action={{ route('admin.question.create') }}>
            @csrf

            <div class="field">
                <label class="label">Subject</label>
                <div class="control">
                    <div class="select">
                        <select name="subject" id="subject">
                            <option>Select relevant subject</option>
                            @foreach ($subjects as $subject)
                                @php
                                    if ($subject->id == old('subject')) {
                                        $subject_model = $subject;
                                    }
                                @endphp
                                <option value="{{ $subject->id }}"
                                    {{ old('subject') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Topic</label>
                <div class="control">
                    <div class="select">
                        <select name="topic" id="topic">
                            @if (old('subject') || old('topic'))

                                @if (count($subject_model->topics) > 0)
                                    <option>Select relevant topic</option>

                                    @foreach ($topics as $topic)
                                        @if ($topic->subject_id == old('subject'))
                                            <option value="{{ $topic->id }}"
                                                {{ old('topic') == $topic->id ? 'selected' : '' }}>
                                                {{ $topic->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option> This subject has no topic </option>
                                @endif
                            @else
                                <option> Select a subject first</option>
                            @endif
                        </select>
                        @error('topic')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Text</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control icons-left">
                            <input class="input" type="text" placeholder="Text" name="question">
                            <span class="icon left"><i class="mdi mdi-mail"></i></span>
                            @error('question')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @for ($i = 1; $i <= 4; $i++)
                @php
                    $choice = 'choice_' . $i;
                @endphp
                <div class="field">
                    <label class="label">Choice {{ $i }}</label>
                    <div class="field-body">
                        <div class="field">
                            <div class="control icons-left">
                                <input class="input" type="text" placeholder="Enter choice " . {{ $i }}
                                    name="{{ $choice }}">
                                <span class="icon left"><i class="mdi mdi-mail"></i></span>
                                @error($choice)
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

            <div class="field">
                <label class="label">Correct Choice</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control icons-left">
                            <input class="input" type="text" placeholder="Text" name="correct_choice">
                            <span class="icon left"><i class="mdi mdi-mail"></i></span>
                            @error('correct_choice')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label">Explanation</label>
                <div class="control">
                    <textarea class="textarea" placeholder="Explain how we can help you" name="explanation"></textarea>
                </div>
            </div>
            <hr>

            <div class="field grouped">
                <div class="control">
                    <button type="submit" class="button green">
                        Submit
                    </button>
                </div>
                <div class="control">
                    <button type="reset" class="button red">
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    </section>
    <script>
        const subjectElement = document.querySelector('#subject');
        const topicElement = document.querySelector('#topic');

        subjectElement.addEventListener('change', function() {
            const subjectElementValue = subjectElement.value;
            const token = document.querySelector('input[name="_token"]').value;

            const data = {
                subjectId: subjectElementValue,
                _token: token,
            }

            fetch('{{ route('admin.subject.topics') }}', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(result) {
                // topicElement.innerHTML = result;
                console.log(data);
                })
        })
    </script>
</x-admin.layout>
