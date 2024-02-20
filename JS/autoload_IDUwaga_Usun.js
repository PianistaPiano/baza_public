function get_textID(event)
{
    var string = event.textContent;
    //Arr = string.split(" ");
    var el1 = document.getElementsByName('ID_konc_U_u');
    if(el1 != null)
    {
        document.getElementsByName('ID_konc_U_u')[0].value = string;
    }  
    document.getElementById('search_result').innerHTML = '';
}

function load_dataID(query)
{
    if(query.length > 1)
    {
        var form_data = new FormData();
        form_data.append('query', query);
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST', 'proces_data_IDUwaga.php');
        ajax_request.send(form_data);
        ajax_request.onreadystatechange = function()
        {
            if(ajax_request.readyState == 4 && ajax_request.status == 200)
            {
                var response = JSON.parse(ajax_request.responseText);
                var html = '<div class="list-group">';
                if(response.length > 0)
                {
                    for(var count = 0; count < response.length; count++)
                    {
                        html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_textID(this)">'+response[count].u_id+'</a>';
                    }
                }
                else
                {
                    html += '<a href="#" class="list-group-item list-group-item-action disabled">Nie znaleziono danych2</a>';
                }
                html += '</div>';
                document.getElementById('search_result').innerHTML = html;
            }
        }
    }
    else
    {
        document.getElementById('search_result').innerHTML = '';
    }
}
