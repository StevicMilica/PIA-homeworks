let questionsData = null;
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
    if (qIndex < questionsData.length - 1) {
        $("#qNext").prop("disabled", false);
        $("#qNext").removeClass("btn-secondary");
        $("#qNext").addClass("btn-info");
        $("#qPrev").removeClass("btn-secondary");
        $("#qPrev").addClass("btn-info");
        qIndex++;
        loadQuestionData(qIndex);
    } else {
        $("#qNext").prop("disabled", true);
        $("#qNext").addClass("btn-secondary");
        $("#qNext").removeClass("btn-info");
    }
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
    } else {
        $("#qPrev").prop("disabled", true);
        $("#qPrev").addClass("btn-secondary");
        $("#qPrev").removeClass("btn-info");
    }
}
let validateAnswer = function (answOpt) {
    let answer = null;
    for (let i = 0; i < answOpt.length; i++) {
        if ($(answOpt[i]).is(":checked")) {
            let indChecked = i;
            answer = $("label[for = '" + $(answOpt[i]).attr("id") + "']").text();
            console.log(answer)
        }
    }
    if (answer == questionsData[qIndex].correct_answer) {
        return 1;
    } else {
        return 0;
    }

}
$("#qNext").click(function () {
    let answerOptions = $("input")
    console.log(answerOptions)
    let result = validateAnswer(answerOptions)
    if (result) {
        alert("Tacan odgovor")
    } else {
        alert("Pogresan odgovor");
    }
    getNextQuestion();
})
$("#qPrev").click(function () {
    getPrevQuestion();
})
for (let i = 0; i < questionsData.length; i++) {
    for (let property in questionsData[i]) {
        document.write(`${property} : ${questionsData[i][property]}`)
        document.write("<br>");
    }
    document.write("<br>");
}