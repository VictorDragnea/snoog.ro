/**
 * Created by victor.dragnea on 15-May-17.
 */

$.ajax({
    url: "https://en.wikipedia.org/w/api.php?action=query&format=json&titles=Einstein",
    dataType: "jason",
    method: "GET",
    headers: {'Api-User-Agent': 'Example/1.0'},
    success: function (data) {
        console.log(data);
    },
});

