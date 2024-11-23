const sendRequest = () => {
    showLoader(true);
    const textarea = document.querySelector("#question");
    const question = textarea.value;
    //console.log(question);

    const response = getData(question);
    response.then((data) => {
        const answer = data.json();

        answer.then((data) => {
            renderAnswer(data);
        })
    })
    const answerDiv = document.querySelector("#answer");
    answerDiv.append("\n\n");
    answerDiv.append(textarea.value);
    
    textarea.value = '';
}

async function getData(question) {
    const url = "ajax/request.php";
    try {
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify({question: question})
        });
        return response;
    } catch (error) {
        console.error(error.message);
        return error.message;
    }
}

const renderAnswer = (aiResponse) => {
    const answerDiv = document.querySelector("#answer");

    aiResponse.choices.map((choice) => {
        console.log(choice.message.content);
        answerDiv.append("\n\n");
        answerDiv.append(choice.message.content);
        scrollToBottom(answerDiv);
    });
 
    showLoader(false);
}

const showLoader = (show) => {
    const loader = document.querySelector('#loader');
    if (show === true) {
        loader.style.visibility = 'visible';
    } else {
        loader.style.visibility = 'hidden';
    }
}

function scrollToBottom(el) {
    el.scrollTop = el.scrollHeight;
}

const startNewConversation = async () => {
    const url = "ajax/start.php";
    try {
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify({style: 'todo'})
        });
        return response;
    } catch (error) {
        console.error(error.message);
        return error.message;
    }
}