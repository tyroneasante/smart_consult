const questionString = document.querySelector('[data-questions]').dataset.questions
const answersString = document.querySelector('[data-answers]').dataset.answers
const questions = JSON.parse(questionString)
const answers = JSON.parse(answersString)
const questionContainer = document.querySelector('.question')
const answersContainer = document.querySelector('.answers')
const transitions = document.querySelectorAll('.transition')
const resetButton = document.querySelector('.reset')
const startButton = document.querySelector('.start')
const backButton = document.querySelector('.back')
const firstQuestionString = document.querySelector('[data-first-question]').dataset.firstQuestion
const firstQuestion = JSON.parse(firstQuestionString)

const previousQuestions = [];

startButton.addEventListener('click', () => {
    backButton.classList.remove('hide')
    startQuiz()
})

resetButton.addEventListener('click', () => {
    // backButton.classList.add('hide')
    startQuiz();
})

answersContainer.addEventListener('click', (e) => {
    if (!e.target.classList.contains('transition')) {
        return;
    }

    const targetUid = e.target.dataset.transitionUid;
    const answer = answers.find(answer => answer.uid.toString() === targetUid.toString());
    const question = questions.find(question => question.uid.toString() === answer.to.toString());

    nextQuestion(question);
});

const nextQuestion = (question) => {
    const prevQuestionId = questionContainer.getAttribute('data-question');
    previousQuestions.push(questions.find(question => question.uid.toString() === prevQuestionId));
    questionContainer.innerHTML = question.question;
    questionContainer.setAttribute('data-question', question.uid)

    const nextAnswers = answers.filter((answer) => {
        return answer.from.toString() === question.uid.toString();
    });
    answersContainer.innerHTML = '';

    if (!nextAnswers.length) {
        resetButton.classList.remove('hide')
        return;
    }

    nextAnswers.map((answer) => {
        answersContainer.innerHTML += `<button class="transition button" data-transition-uid="${answer.uid}">${answer.option}</button>`;
    });
}

backButton.addEventListener('click', () =>{
    goBack()
})

const goBack = () => {
    const prevQuestion = previousQuestions[previousQuestions.length - 1]

    previousQuestions.pop()
    nextQuestion(prevQuestion)
    previousQuestions.pop()
    resetButton.classList.add('hide')
}

const startQuiz = () => {
    resetButton.classList.add('hide')
    startButton.classList.add('hide')
    questionContainer.innerHTML = firstQuestion.question.question;
    questionContainer.setAttribute('data-question', firstQuestion.question.uid)

    firstQuestion.answers.map((answer) => {
        answersContainer.innerHTML += `<button class="transition button" data-transition-uid="${answer.uid}">${answer.option}</button>`;
    });
}

resetQuiz = () => {

}
