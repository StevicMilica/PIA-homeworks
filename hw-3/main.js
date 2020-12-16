let questionsData = null;
$.ajax({
    'async': false,
    'global': false,
    'url': "./questions.json",
    'dataType': "json",
    'success': function (data) {
        questionsData = data;
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