<script type="importmap">
    {
        "imports": {
            "ckeditor5": "/assets/vendor/ckeditor5.js",
            "ckeditor5/": "/assets/vendor/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font,
        BlockQuote,
        FontFamily, 
        FontSize,
        FontColor,
        FontBackgroundColor,
        Strikethrough,
        Subscript,
        Superscript,
        Code, CodeBlock,
        Alignment,
        Link,
        List,
        TodoList,
        Indent,
        IndentBlock,
        Heading
    } from 'ckeditor5';

    ClassicEditor
        .create( {
            attachTo: document.querySelector( '#editor' ),
            licenseKey: 'GPL',
            plugins: [
                Essentials, Paragraph, Bold, Italic, Font, FontFamily, FontSize, FontColor, FontBackgroundColor, Strikethrough, Subscript, Superscript, Code, CodeBlock, Alignment, Link, 
                BlockQuote, List, TodoList, Indent, IndentBlock, Heading
            ],
            toolbar: {
            items: [
                'undo', 'redo',
                '|', 'heading',
                '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                '-', // break point
                '|', 'alignment',
                'link', 'blockQuote', 'codeBlock',
                '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
            ],
            shouldNotGroupWhenFull: true
        }

        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>