// magic.js
$(document).ready(function() {

    (function(){
        $.ajax({
            type: "GET",
            url: "/api/incident/1?api_token=qiv6Mp28xEWBDDuuCxxG3nhuAXQFiMT2rexMOcMqLnefP31fEPH2GnHISsXp",
            data: {},
            dataType: 'json',
            success: function(data){
                var html = null;

                $.each(data['incidents'], function(k, v) {
                    if (v['resolved'] == 0) {
                        html += "<tr class='error'>";
                   } else {
                        html += "<tr>";
                   }

                    html += "<td>" + v['uuid'] + "</td>";
                    html += "<td>" + v['first_name'] + "</td>";
                    html += "<td>" + v['last_name'] + "</td>";
                    html += "<td>" + v['phone'] + "</td>";
                    html += "<td>" + v['location'] + "</td>";
                    html += "<td>" + v['created_at'] + "</td>";
                    html += "</tr>";
                });

                $('#indicents-data').html(html);
            },
            error: function (response) {
            }
        });

        setTimeout(arguments.callee, 5000);
    })();

});
