function get_text(event)
{
    var string = event.textContent;
    Arr = string.split(";");
    document.getElementsByName('Imie')[0].value = Arr[0];
    document.getElementsByName('Nazwisko')[0].value = Arr[1];
    document.getElementsByName('Pesel')[0].value = Arr[2];
    document.getElementsByName('nr_tel')[0].value = Arr[3];
    document.getElementsByName('Adres')[0].value = Arr[4];
    document.getElementById('search_result').innerHTML = '';
}

function load_data(query)
{
    if(query.length > 2)
    {
        var form_data = new FormData();
        form_data.append('query', query);
        var ajax_request = new XMLHttpRequest();
        ajax_request.open('POST', 'proces_data.php');
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
                        html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">'+response[count].Imie +
                        ';'+response[count].Nazwisko+';'+response[count].Pesel+';'+response[count].Telefon+';'+response[count].Adres+'</a>';
                    }
                }
                else
                {
                    html += '<a href="#" class="list-group-item list-group-item-action disabled">Nie znaleziono danych</a>';
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
