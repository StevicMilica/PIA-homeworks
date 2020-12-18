let questionsData = null;
$.ajax({
    'async': false,
    'global': false,
    'url': "./questions.json",
    'dataType': "json",
    'success': function (data) {
        questionsData = data;
        $("#qNumber").text("Pitanje br. " + questionsData[0].question_id)
        $("#qText").text("Pitanje: " + questionsData[0].question_text)
        let qOptions = $(".qOption")
        console.log(qOptions)
        let answers = questionsData[0].answers;
        for(let i = 0; i < answers.length;i++){
            $(qOptions[i]).text(answers[i]);
        }
    }
});
for(let i = 0; i < questionsData.length; i++){
    for(let property in questionsData[i]){
        document.write(`${property} : ${questionsData[i][property]}`)
        document.write("<br>");
    }
    document.write("<br>");
}
console.log(questionsData)