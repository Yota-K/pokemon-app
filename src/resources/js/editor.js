import SimpleMDE from 'simplemde';
import 'simplemde/dist/simplemde.min.css';

window.addEventListener('DOMContentLoaded', () => {
    const editorEl = document.getElementById('editor');
    const hiddenEditor = document.getElementById('hidden-editor');
    const submitBtn = document.getElementById('submit-btn');

    const simpleEditor = new SimpleMDE({
        element: editorEl
    });

    if (submitBtn !== null) {
        submitBtn.addEventListener('click', (e) => {
            // エディター内のテキストをtextareaコピー
            simpleEditor.codemirror.save();
            hiddenEditor.value = editorEl.value;
        })
    }
});
