<div wire:ignore>
    <div id="{{ $name }}">
        {!! $content !!}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Initialize Quill
            const quill = new Quill('#{{ $name }}', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{'header': [1, 2, 3, 4, 5, 6, false]}],
                        ['bold', 'italic', 'underline', 'strike', 'blockquote', 'code-block'],
                        ['link', 'image', 'video', 'formula'],
                        [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                        [{'indent': '-1'}, {'indent': '+1'}],
                        [{'align': []}],
                        ['clean']
                    ],
                    clipboard: {
                        matchVisual: false
                    }
                }
            });

            // Add markdown support
            const quillMarkdown = new QuillMarkdown(quill)

            // Set content
            quill.on('text-change', function () {
                let html = document.getElementsByClassName('ql-editor')[0].innerHTML;
                @this.set('content', html)
            })

            // Save on ctrl+s
            document.addEventListener('keydown', function (event) {
                if ((event.ctrlKey || event.metaKey) && event.key === 's') {
                    Livewire.dispatch('{{\App\Livewire\Editor::EVENT_TRIGGER_SAVE}}');
                    event.preventDefault();
                }
            });
        })
    </script>
</div>
