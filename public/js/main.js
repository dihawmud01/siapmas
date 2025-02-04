(function ($) {
    "use strict";

    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    $(".main-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        center: true,
    });

    $(".tranding-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>'
        ]
    });

    $(".carousel-item-1").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ]
    });

    $(".carousel-item-2").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            }
        }
    });

    $(".carousel-item-3").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    $(".carousel-item-4").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });

})(jQuery);

// const {
//     ClassicEditor,
//     Alignment,
//     Autoformat,
//     AutoImage,
//     AutoLink,
//     Autosave,
//     BalloonToolbar,
//     Base64UploadAdapter,
//     BlockQuote,
//     BlockToolbar,
//     Bold,
//     Bookmark,
//     CloudServices,
//     Code,
//     CodeBlock,
//     Essentials,
//     FindAndReplace,
//     FontBackgroundColor,
//     FontColor,
//     FontFamily,
//     FontSize,
//     FullPage,
//     GeneralHtmlSupport,
//     Heading,
//     Highlight,
//     HorizontalLine,
//     HtmlComment,
//     HtmlEmbed,
//     ImageBlock,
//     ImageCaption,
//     ImageInline,
//     ImageInsert,
//     ImageInsertViaUrl,
//     ImageResize,
//     ImageStyle,
//     ImageTextAlternative,
//     ImageToolbar,
//     ImageUpload,
//     Indent,
//     IndentBlock,
//     Italic,
//     Link,
//     LinkImage,
//     List,
//     ListProperties,
//     Markdown,
//     MediaEmbed,
//     Mention,
//     PageBreak,
//     Paragraph,
//     PasteFromMarkdownExperimental,
//     PasteFromOffice,
//     RemoveFormat,
//     ShowBlocks,
//     SourceEditing,
//     SpecialCharacters,
//     SpecialCharactersArrows,
//     SpecialCharactersCurrency,
//     SpecialCharactersEssentials,
//     SpecialCharactersLatin,
//     SpecialCharactersMathematical,
//     SpecialCharactersText,
//     Strikethrough,
//     Style,
//     Subscript,
//     Superscript,
//     Table,
//     TableCaption,
//     TableCellProperties,
//     TableColumnResize,
//     TableProperties,
//     TableToolbar,
//     TextPartLanguage,
//     TextTransformation,
//     Title,
//     TodoList,
//     Underline,
//     WordCount
// } = window.CKEDITOR;
//
// const LICENSE_KEY =
//     'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Mzg1NDA3OTksImp0aSI6ImU0MWE3MjY1LTcyOGQtNDhmNS04YjU4LTNhZmMxYjJiZjQxMSIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6Ijk1YjBjZWI4In0.jRVvvvRzqZctTtnDE069_yZjTGxmM-kLVFI7Dur2T0two5-PEpybGpNYOM8rFXVwXNDScXiblAL8BPBzmmEqqA';
//
// const editorConfig = {
//     toolbar: {
//         items: [
//             'sourceEditing',
//             'showBlocks',
//             '|',
//             'heading',
//             'style',
//             '|',
//             'fontSize',
//             'fontFamily',
//             'fontColor',
//             'fontBackgroundColor',
//             '|',
//             'bold',
//             'italic',
//             'underline',
//             '|',
//             'link',
//             'insertImage',
//             'insertTable',
//             'highlight',
//             'blockQuote',
//             'codeBlock',
//             '|',
//             'alignment',
//             '|',
//             'bulletedList',
//             'numberedList',
//             'todoList',
//             'outdent',
//             'indent'
//         ],
//         shouldNotGroupWhenFull: false
//     },
//     plugins: [
//         Alignment,
//         Autoformat,
//         AutoImage,
//         AutoLink,
//         Autosave,
//         BalloonToolbar,
//         Base64UploadAdapter,
//         BlockQuote,
//         BlockToolbar,
//         Bold,
//         Bookmark,
//         CloudServices,
//         Code,
//         CodeBlock,
//         Essentials,
//         FindAndReplace,
//         FontBackgroundColor,
//         FontColor,
//         FontFamily,
//         FontSize,
//         FullPage,
//         GeneralHtmlSupport,
//         Heading,
//         Highlight,
//         HorizontalLine,
//         HtmlComment,
//         HtmlEmbed,
//         ImageBlock,
//         ImageCaption,
//         ImageInline,
//         ImageInsert,
//         ImageInsertViaUrl,
//         ImageResize,
//         ImageStyle,
//         ImageTextAlternative,
//         ImageToolbar,
//         ImageUpload,
//         Indent,
//         IndentBlock,
//         Italic,
//         Link,
//         LinkImage,
//         List,
//         ListProperties,
//         Markdown,
//         MediaEmbed,
//         Mention,
//         PageBreak,
//         Paragraph,
//         PasteFromMarkdownExperimental,
//         PasteFromOffice,
//         RemoveFormat,
//         ShowBlocks,
//         SourceEditing,
//         SpecialCharacters,
//         SpecialCharactersArrows,
//         SpecialCharactersCurrency,
//         SpecialCharactersEssentials,
//         SpecialCharactersLatin,
//         SpecialCharactersMathematical,
//         SpecialCharactersText,
//         Strikethrough,
//         Style,
//         Subscript,
//         Superscript,
//         Table,
//         TableCaption,
//         TableCellProperties,
//         TableColumnResize,
//         TableProperties,
//         TableToolbar,
//         TextPartLanguage,
//         TextTransformation,
//         Title,
//         TodoList,
//         Underline,
//         WordCount
//     ],
//     balloonToolbar: ['bold', 'italic', '|', 'link', 'insertImage', '|', 'bulletedList', 'numberedList'],
//     blockToolbar: [
//         'fontSize',
//         'fontColor',
//         'fontBackgroundColor',
//         '|',
//         'bold',
//         'italic',
//         '|',
//         'link',
//         'insertImage',
//         'insertTable',
//         '|',
//         'bulletedList',
//         'numberedList',
//         'outdent',
//         'indent'
//     ],
//     fontFamily: {
//         supportAllValues: true
//     },
//     fontSize: {
//         options: [10, 12, 14, 'default', 18, 20, 22],
//         supportAllValues: true
//     },
//     heading: {
//         options: [
//             {
//                 model: 'paragraph',
//                 title: 'Paragraph',
//                 class: 'ck-heading_paragraph'
//             },
//             {
//                 model: 'heading1',
//                 view: 'h1',
//                 title: 'Heading 1',
//                 class: 'ck-heading_heading1'
//             },
//             {
//                 model: 'heading2',
//                 view: 'h2',
//                 title: 'Heading 2',
//                 class: 'ck-heading_heading2'
//             },
//             {
//                 model: 'heading3',
//                 view: 'h3',
//                 title: 'Heading 3',
//                 class: 'ck-heading_heading3'
//             },
//             {
//                 model: 'heading4',
//                 view: 'h4',
//                 title: 'Heading 4',
//                 class: 'ck-heading_heading4'
//             },
//             {
//                 model: 'heading5',
//                 view: 'h5',
//                 title: 'Heading 5',
//                 class: 'ck-heading_heading5'
//             },
//             {
//                 model: 'heading6',
//                 view: 'h6',
//                 title: 'Heading 6',
//                 class: 'ck-heading_heading6'
//             }
//         ]
//     },
//     htmlSupport: {
//         allow: [
//             {
//                 name: /^.*$/,
//                 styles: true,
//                 attributes: true,
//                 classes: true
//             }
//         ]
//     },
//     image: {
//         toolbar: [
//             'toggleImageCaption',
//             'imageTextAlternative',
//             '|',
//             'imageStyle:inline',
//             'imageStyle:wrapText',
//             'imageStyle:breakText',
//             '|',
//             'resizeImage'
//         ]
//     },
//     initialData:
//         '<h2>Congratulations on setting up CKEditor 5! 🎉</h2>\n<p>\n\tYou\'ve successfully created a CKEditor 5 project. This powerful text editor\n\twill enhance your application, enabling rich text editing capabilities that\n\tare customizable and easy to use.\n</p>\n<h3>What\'s next?</h3>\n<ol>\n\t<li>\n\t\t<strong>Integrate into your app</strong>: time to bring the editing into\n\t\tyour application. Take the code you created and add to your application.\n\t</li>\n\t<li>\n\t\t<strong>Explore features:</strong> Experiment with different plugins and\n\t\ttoolbar options to discover what works best for your needs.\n\t</li>\n\t<li>\n\t\t<strong>Customize your editor:</strong> Tailor the editor\'s\n\t\tconfiguration to match your application\'s style and requirements. Or\n\t\teven write your plugin!\n\t</li>\n</ol>\n<p>\n\tKeep experimenting, and don\'t hesitate to push the boundaries of what you\n\tcan achieve with CKEditor 5. Your feedback is invaluable to us as we strive\n\tto improve and evolve. Happy editing!\n</p>\n<h3>Helpful resources</h3>\n<ul>\n\t<li>📝 <a href="https://portal.ckeditor.com/checkout?plan=free">Trial sign up</a>,</li>\n\t<li>📕 <a href="https://ckeditor.com/docs/ckeditor5/latest/installation/index.html">Documentation</a>,</li>\n\t<li>⭐️ <a href="https://github.com/ckeditor/ckeditor5">GitHub</a> (star us if you can!),</li>\n\t<li>🏠 <a href="https://ckeditor.com">CKEditor Homepage</a>,</li>\n\t<li>🧑‍💻 <a href="https://ckeditor.com/ckeditor-5/demo/">CKEditor 5 Demos</a>,</li>\n</ul>\n<h3>Need help?</h3>\n<p>\n\tSee this text, but the editor is not starting up? Check the browser\'s\n\tconsole for clues and guidance. It may be related to an incorrect license\n\tkey if you use premium features or another feature-related requirement. If\n\tyou cannot make it work, file a GitHub issue, and we will help as soon as\n\tpossible!\n</p>\n',
//     language: 'id',
//     licenseKey: LICENSE_KEY,
//     link: {
//         addTargetToExternalLinks: true,
//         defaultProtocol: 'https://',
//         decorators: {
//             toggleDownloadable: {
//                 mode: 'manual',
//                 label: 'Downloadable',
//                 attributes: {
//                     download: 'file'
//                 }
//             }
//         }
//     },
//     list: {
//         properties: {
//             styles: true,
//             startIndex: true,
//             reversed: true
//         }
//     },
//     mention: {
//         feeds: [
//             {
//                 marker: '@',
//                 feed: [
//                     /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
//                 ]
//             }
//         ]
//     },
//     menuBar: {
//         isVisible: true
//     },
//     placeholder: 'Type or paste your content here!',
//     style: {
//         definitions: [
//             {
//                 name: 'Article category',
//                 element: 'h3',
//                 classes: ['category']
//             },
//             {
//                 name: 'Title',
//                 element: 'h2',
//                 classes: ['document-title']
//             },
//             {
//                 name: 'Subtitle',
//                 element: 'h3',
//                 classes: ['document-subtitle']
//             },
//             {
//                 name: 'Info box',
//                 element: 'p',
//                 classes: ['info-box']
//             },
//             {
//                 name: 'Side quote',
//                 element: 'blockquote',
//                 classes: ['side-quote']
//             },
//             {
//                 name: 'Marker',
//                 element: 'span',
//                 classes: ['marker']
//             },
//             {
//                 name: 'Spoiler',
//                 element: 'span',
//                 classes: ['spoiler']
//             },
//             {
//                 name: 'Code (dark)',
//                 element: 'pre',
//                 classes: ['fancy-code', 'fancy-code-dark']
//             },
//             {
//                 name: 'Code (bright)',
//                 element: 'pre',
//                 classes: ['fancy-code', 'fancy-code-bright']
//             }
//         ]
//     },
//     table: {
//         contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
//     }
// };
//
// ClassicEditor.create(document.querySelector('#editor'), editorConfig).then(editor => {
//     const wordCount = editor.plugins.get('WordCount');
//     document.querySelector('#editor-word-count').appendChild(wordCount.wordCountContainer);
//
//     document.querySelector('#editor-menu-bar').appendChild(editor.ui.view.menuBarView.element);
//
//     return editor;
// });
