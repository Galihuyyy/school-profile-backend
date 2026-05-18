<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CKEditor 5 - Quick start ZIP</title>
        <link rel="stylesheet" href="../../assets/vendor/ckeditor5.css">
        <style>
            .main-container {
                width: 795px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <div class="main-container">
            <div id="editor">
                <p>Hello from CKEditor 5!</p>
            </div>
        </div>
        <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "../../assets/vendor/ckeditor5.js",
                    "ckeditor5/": "../../assets/vendor/"
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
    </body>
</html>
