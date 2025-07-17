$(document).ready(function(){
    document.addEventListener('DOMContentLoaded', function() {
        let answerIndex = 1;

        document.getElementById('add-answer').addEventListener('click', function() {
            let container = document.getElementById('answers-container');
            let newAnswer = document.createElement('div');
            newAnswer.classList.add('form-group', 'answer-item');
            newAnswer.innerHTML = `
                <label for="answers[${answerIndex}]">Answer</label>
                <input type="text" name="answers[${answerIndex}][answer]" class="form-control" required>
                <input type="hidden" name="answers[${answerIndex}][is_correct]" value="0">
                <button type="button" class="btn btn-danger remove-answer">Remove</button>
            `;
            container.appendChild(newAnswer);
            answerIndex++;
        });

        document.getElementById('answers-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-answer')) {
                e.target.parentElement.remove();
            }
        });
    });
});
