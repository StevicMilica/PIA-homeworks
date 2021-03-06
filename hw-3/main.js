let questionsData = null;
let correctCount = 0;
let userAnswers = []
let qIndex = 0;

$(document).ready(function () {

 
    $("body").fadeIn();
})
let loadQuestionData = function (index) {
    $("#qNumber").text("Pitanje br. " + questionsData[index].question_id)
    $("#qText").text("Pitanje: " + questionsData[index].question_text)
    if (!questionsData[index].fillable) {
        $("#qAnswers").fadeIn();
        $("#qTextAnswer").fadeOut();
        let qOptions = $(".qOption")
        let answers = questionsData[index].answers;
        for (let i = 0; i < answers.length; i++) {
            $(qOptions[i]).text(answers[i]);
        }
    } else {
        $("#answerText").val('');
        $("#qTextAnswer").fadeIn();
        $("#qAnswers").fadeOut();

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
    let answerOptions = $("input")
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
    }, 1000);
})

$("#qSkip").click(function () {
    let answerOptions = $("input")
    userAnswers[qIndex] = -1;
    getNextQuestion();
})
$("#giveUp").click(function () {
    finishQuiz();
    qIndex = 0;

})
$("#quizStart").click(function () {
    if ($("#userName").val() == '') {
        alert("Korisnicko ime je obavezno, unesite ga u polju ispod")
    } else {
        let username = $("#userName").val();
        sessionStorage.setItem('username', username)
        $("#userData").slideToggle();
        $("#quizContainer").slideDown();
        startTimer();
    }
})
$("#reset").click(function () {
    reset();
})
let showResults = function () {
    writeResults();
    $("#resultData").slideToggle();
}
let writeResults = function () {
    let results = getResults();
    for (let i = 0; i < results.length; i++) {
        let element = "<tr><td>" + results[i].userName + "</td><td>" + results[i].result + "</td></tr>"
        $("#resultsBody").append(element);
    }
}
let getResults = function () {
    let res = JSON.parse(localStorage.getItem("results"));
    if (res == null) {
        res = []
    }
    for (let i = 0; i < res.length - 1; i++) {
        let max = res[i]
        let maxInd = i
        for (let j = i + 1; j < res.length; j++) {
            if (res[j].result > max.result ) {
                max = res[j];
                maxInd = j
            }
            if (res[j].result == max.result && res[j].userName < max.userName) {
                max = res[j];
                maxInd = j;
            }
        }
        console.log(max)
        if (res[i].result < max.result) {
            let temp = res[i]
            res[i] = max
            res[maxInd] = temp
        }
    }


    return res;
}
getResults()
let storeResults = function () {
    let results = getResults();
    let userName = sessionStorage.getItem("username");
    let result = correctCount;
    let userProfile = {
        "userName": userName,
        "result": result
    }
    results.push(userProfile)
    localStorage.setItem("results", JSON.stringify(results));
}

let reset = function () {
    location.reload();
}

let validateAnswer = function (answOpt) {
    if (answOpt == null)
        return 0;
    let answer = null;
    let answered = false;
    if (!questionsData[qIndex].fillable) {
        for (let i = 0; i < answOpt.length; i++) {
            if ($(answOpt[i]).is(":checked")) {
                let indChecked = i;
                answer = $("label[for = '" + $(answOpt[i]).attr("id") + "']").text();
                userAnswers[qIndex] = indChecked;
                answered = true;
                break;
            }
        }
        if (!answered) {
            userAnswers[qIndex] = -1;
        }
    } else {
        answer = $("#answerText").val();
        if (!answer == '') {
            userAnswers[qIndex] = -1;
        }
    }
    if (answer.toLowerCase() == questionsData[qIndex].correct_answer.toLowerCase()) {
        return 1;
    } else {
        return 0;
    }

}
let getNextQuestion = function () {
    startTimer();
    let finish = false;
    let inputs = $("input");
    for (let i = 0; i < inputs.length; i++) {
        $(inputs[i]).prop("checked", false);
    }
    if (qIndex < questionsData.length) {
        if (qIndex < questionsData.length - 1) {
            qIndex++;
            loadQuestionData(qIndex);
        } else {
            qIndex++;
        }

    }
    if (qIndex == questionsData.length - 1) {
        $("#qNext").addClass("btn-success");
        $("#qNext").removeClass("btn-info");
        $("#qNext").text("Zavrsi kviz");

    }
    if (qIndex == questionsData.length) {
        finishQuiz();
    }
}
let finishQuiz = function () {
    storeResults();
    showResults();
    $("#timerContainer").slideUp();
    stopTimer();
    $("#quizContainer").slideToggle();
}
let interval;
let time = 20;

function timer() {
    $("#timer").text("00:" + time);
    interval = setInterval(function () {
        time--;
        $("#timer").text("00:" + time);

        if (time < 10) {
            $("#timer").text("00:0" + time);
            $("#timer").css("color", "red")
        }
        if (time <= 0) {
            validateAnswer(null);
            $("#timeExpired").slideDown();
            setTimeout(function () {
                $("#timeExpired").slideUp();
                getNextQuestion();
            }, 1000)
            clearInterval(interval)
        }
    }, 1000);

}

function startTimer() {
    time = 20;
    $("#timer").css("color", "black")
    stopTimer();
    $("#timerContainer").slideDown()
    timer();
}

function stopTimer() {
    clearInterval(interval);
}