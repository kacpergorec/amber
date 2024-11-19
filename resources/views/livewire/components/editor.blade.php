    <div wire:ignore>
        <div id="{{ $name }}">
            {!! $value !!}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const quill = new Quill('#{{ $name }}', {
                    theme: 'snow'
                });

                quill.on('text-change', function () {
                    let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                    @this.set('value', value)
                })
            })
        </script>
    </div>
