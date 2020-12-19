let questionsData = null;
let correctCount = 0;
let userAnswers = []
let qIndex = 0;
let loadQuestionData = function (index) {
    $("#qNumber").text("Pitanje br. " + questionsData[index].question_id)
    $("#qText").text("Pitanje: " + questionsData[index].question_text)
    let qOptions = $(".qOption")
    let answers = questionsData[index].answers;
    for (let i = 0; i < answers.length; i++) {
        $(qOptions[i]).text(answers[i]);
    }
}

$.ajax({
    'async': false,
    'global': false,
    'url': "./questions.json",
    'dataType': "json",
    'success': function (data) {
        questionsData = data;
        loadQuestionData(qIndex)
    }
});



let getNextQuestion = function () {
    let inputs = $("input");
    for (let i = 0; i < inputs.length; i++) {
        $(inputs[i]).prop("checked", false);
    }
    if (qIndex < questionsData.length - 1) {
        $("#qNext").prop("disabled", false);
        $("#qNext").removeClass("btn-secondary");
        $("#qNext").addClass("btn-info");
        $("#qPrev").removeClass("btn-secondary");
        $("#qPrev").addClass("btn-info");
        qIndex++;
        loadQuestionData(qIndex);
        checkIfAnswered(qIndex);

    } else {
        $("#qNext").prop("disabled", true);
        $("#qNext").addClass("btn-secondary");
        $("#qNext").removeClass("btn-info");
        alert(`Kviz je gotov. Imali ste ${correctCount} od ${questionsData.length} poena`)
    }
    console.log(userAnswers)
}
let getPrevQuestion = function () {
    if (qIndex > 0) {
        $("#qPrev").prop("disabled", false);
        $("#qPrev").removeClass("btn-secondary");
        $("#qPrev").addClass("btn-info");
        $("#qNext").removeClass("btn-secondary");
        $("#qNext").addClass("btn-info");
        qIndex--;
        loadQuestionData(qIndex)
        checkIfAnswered(qIndex);

    } else {
        $("#qPrev").prop("disabled", true);
        $("#qPrev").addClass("btn-secondary");
        $("#qPrev").removeClass("btn-info");
    }
}
let validateAnswer = function (answOpt) {
    let answer = null;
    let answered = false;
    for (let i = 0; i < answOpt.length; i++) {
        if ($(answOpt[i]).is(":checked")) {
            let indChecked = i;
            answer = $("label[for = '" + $(answOpt[i]).attr("id") + "']").text();
            console.log(answer)
            userAnswers[qIndex] = indChecked;
            answered = true;
            break;
        }
    }
    if (!answered) {
        userAnswers[qIndex] = -1;
    }
    if (answer == questionsData[qIndex].correct_answer) {
        return 1;
    } else {
        return 0;
    }

}
let checkIfAnswered = function (qInd) {
    let qOptions = $("input");
    if (userAnswers[qInd] != undefined) {
        console.log(`qInd = ${qInd}`)
        console.log(qOptions[qInd])
        $(qOptions[userAnswers[qInd]]).prop('checked', true);
    }
}
$("#qNext").click(function () {
    let answerOptions = $("input")
    console.log(answerOptions)
    let result = validateAnswer(answerOptions)
    if (result) {
        $("#answerCorrect").slideToggle();
        $("#answerIncorrect").hide();

        correctCount++;
    } else {
        $("#answerCorrect").hide();
        $("#answerIncorrect").slideToggle();
    }
    setTimeout(function () {
        $("#answerCorrect").slideUp();
        $("#answerIncorrect").slideUp();

        getNextQuestion();
    }, 3000);
})
$("#qPrev").click(function () {
    getPrevQuestion();
})
$("#qSkip").click(function () {
    let answerOptions = $("input")
    console.log(answerOptions)
    userAnswers[qIndex] = -1;
    getNextQuestion();
})
$("#quizStart").click(function () {
    if ($("#userName").val() == '') {
        alert("Korisnicko ime je obavezno, unesite ga u polju ispod")
    }
    else{
        // console.log("Promenjen")
        let username = $("#userName").val();
        sessionStorage.setItem('username',username)
        $("#userData").slideToggle();
        $("#quizContainer").slideDown();
        
    }
})

let storeResults = function () {
    let results = JSON.parse(localStorage.getItem("results"));
    let userName = sessionStorage.getItem("username");
    let result = correctCount;
    let userProfile = {
        "userName": userName,
        "result": result
    }
    results.push(userProfile)
    localStorage.setItem("results", JSON.stringify(results));
}