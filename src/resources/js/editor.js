import SimpleMDE from 'simplemde';
import 'simplemde/dist/simplemde.min.css';

const editorEl = document.getElementById('editor');
const hiddenEditor = document.getElementById('hidden-editor');
const submitBtn = document.getElementById('submit-btn');

const simpleEditor = new SimpleMDE({
    element: editorEl
});

submitBtn.addEventListener('click', (e) => {
    // エディター内のテキストをtextareaコピー
    simpleEditor.codemirror.save();
    hiddenEditor.value = editorEl.value;
})
