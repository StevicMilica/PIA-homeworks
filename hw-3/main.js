let questionsData = null;
let qIndex = 0;
let loadQuestionData = function (index) {
    $("#qNumber").text("Pitanje br. " + questionsData[index].question_id)
    $("#qText").text("Pitanje: " + questionsData[index].question_text)
    let qOptions = $(".qOption")
    console.log(qOptions)
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
$("#qNext").click(function () {
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
})
$("#qPrev").click(function () {
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
})
for (let i = 0; i < questionsData.length; i++) {
    for (let property in questionsData[i]) {
        document.write(`${property} : ${questionsData[i][property]}`)
        document.write("<br>");
    }
    document.write("<br>");
}
console.log(questionsData)