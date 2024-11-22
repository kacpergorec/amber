<div wire:ignore>
    <div id="{{ $name }}">
        {!! $value !!}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#{{ $name }}', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': '1'}, {'header': '2'}, { 'font': [] }],
                        [{size: []}],
                        ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                        [{'list': 'ordered'}, {'list': 'bullet'},
                            {'indent': '-1'}, {'indent': '+1'}],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],
                    clipboard: {
                        matchVisual: false
                    }
                }
            });

            const quillMarkdown = new QuillMarkdown(quill)

            quill.on('text-change', function() {
                let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                @this.
                set('value', value)
            })
        })
    </script>
</div>
