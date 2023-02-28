$(document).on("click", ".btn", async function (e) {
    let request = {"status": ""}
    if (e.currentTarget.classList.contains("toLearn")) {
        request.status = "learn"
    } else if (e.currentTarget.classList.contains("known")) {
        request.status = "known"
    } else {
        return
    }

    let idEnWord = e.currentTarget.closest("tr").getAttribute('id')
    await enWordSetStatus(idEnWord, request)
})



function enWordSetStatus(id, request) {
    let url = '/apiEnWordsForLearn/' + id;
    return fetch(
        url,
        {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json;charset=utf-8',
            },
            body: JSON.stringify(request)
        }
    ).then(function (response) {
            return response.json()
        }
    ).catch(function (err) {
        console.log(err);
    })
}
