
@section('viewsScripts')

<script>

    let flagLanguage = $("#headerTopFlag").data("language");
    var arreglo = [""];

    // Devuelve una función, programación de alto orden
    function randomNoRepeats(array) {
        var copy = array.slice(0);
        return function() {
            if (copy.length < 1) { copy = array.slice(0); }
            var index = Math.floor(Math.random() * copy.length);
            var item = copy[index];
            copy.splice(index, 1);
            var itemIndex = array.indexOf(item);
            array.splice(itemIndex, 1); 
            return item;
        };
    }

    function randomElement(array, cnt) {
        let res = array.sort(function() {
            return 0.5 - Math.random();
        });
        return res.slice(array,cnt);
    }

    function createNewsCard(res=null){
        console.log(res);
        // console.log(res.articles);
        let arr = [...new Set(res.filter
        (filter=>filter.description && filter.publishedAt && filter.source.name && filter.title && filter.url))];
        
        console.log(arr); 

        arr = arr.map(JSON.stringify).reverse()
        .filter(function(item, index, arr){ return arr.indexOf(item, index + 1) === -1; }) 
        .reverse().map(JSON.parse) 
        
        console.log(arr); 

        let newsFound = $('#newsContainer');
        $("#newsContainer").empty();
        let data =  $('<div />');
        let indexArticle = 0;
        for (let i=1;i<=5;i++){

            let dataArt = randomNoRepeats(arr)();
            // console.log("dataArt: ",dataArt);
            // console.log("array fuera ORIGINAL: ", arr);
            if (!dataArt){
                continue;
            }
            indexArticle++;
            var mydate = new Date(dataArt.publishedAt);
            let publishedDate;
            switch(flagLanguage){
              case "es":
                publishedDate = new Intl.DateTimeFormat('es-ES', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
                break;
              case "en":
                publishedDate = new Intl.DateTimeFormat('en-GB', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
                break;
              case "it":
                publishedDate = new Intl.DateTimeFormat('it-IT', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
                break;
              default:
                publishedDate = new Intl.DateTimeFormat('es-ES', { dateStyle: 'full', timeStyle: 'long' }).format(mydate);
                break;
            }
            publishedDate = publishedDate.substring(0, publishedDate.length-8);
            dataArt.author = dataArt.author??"@lang('messages.news anonymous')";

            let dataContent = (dataArt.content == null) ? '' : dataArt.content;
            let lastCharacterDescription = dataArt.description.slice(-1);
            dataContent = (lastCharacterDescription == ".") ? dataContent : lastCharacterDescription.concat(dataContent);
            let container = $('<div />').addClass("container py-5 jumbotron-container");
            let jumbotron = $('<div />').addClass("jumbotron text-white jumbotron-image shadow").attr('data-img', dataArt.urlToImage);
            let jumbotronTitle = $('<h2 />').addClass("mb-4 p-3 bg-white opacity-4 shadow jumbotron-title text-dark").text(dataArt.title+".");
            
            let jumbotronContainerRow =  $('<div />').addClass("row");
            let jumbotronP = $('<p />').addClass("mb-4 jumbotron-text bg-white text-muted col-lg-8").text(dataArt.description +" "+ dataContent);
            let blockquote  = $('<blockquote />').addClass("mt-1 blockquote mb-0 blockquote-footer text-right").text("@lang('messages.news source')");
            let blockquotecite = $('<cite />').attr('title', 'sample').text(dataArt.source.name);
            let jumbotronRightContainerRow = $('<p />').addClass("col-lg-4 jumbotron-container-right");
            let jumbotronInnerAuthor = $('<span />').addClass("font-italic").text(dataArt.author);
            let jumbotronAuthor = $('<p />').addClass("mb-4 jumbotron-author bg-white text-muted").text("@lang('messages.news author')");
            let jumbotronInnerDate = $('<div />').addClass("jumbotron-inner-date font-italic").text(publishedDate);
            let jumbotronDate = $('<p />').addClass("mb-4 jumbotron-date bg-white text-muted").text("@lang('messages.news published')");
            let jumbotronLinkContainer = $('<div />').addClass("text-center");
            let jumbotronLinkButton = $('<a />').addClass("btn btn-primary jumbotron-link").attr('href', dataArt.url).attr('target', "_blank").text("@lang('messages.news link')");
            jumbotronLinkContainer = jumbotronLinkContainer.append(jumbotronLinkButton);
            blockquote = blockquote.append(blockquotecite);
            jumbotronP = jumbotronP.append(blockquote);
            jumbotronAuthor = jumbotronAuthor.append(jumbotronInnerAuthor);
            jumbotronDate = jumbotronDate.append(jumbotronInnerDate);
            jumbotronRightContainerRow = jumbotronRightContainerRow.append(jumbotronAuthor).append(jumbotronDate);
            jumbotronContainerRow = jumbotronContainerRow.append(jumbotronP).append(jumbotronRightContainerRow);
            jumbotron = jumbotron.append(jumbotronTitle).append(jumbotronContainerRow).append(jumbotronLinkContainer);
            container = container.append(jumbotron);

            let image = document.createElement('img');
            image.src= dataArt.urlToImage;
          
            jumbotron.css('background-image', 'url('+_publicUrl+'images/clouds.jpg'+')');
            $(image).on("error", function () {
                jumbotron.css('background-image', 'url('+_publicUrl+'images/clouds.jpg'+')');
            });
            jumbotron.css('background-image', 'url('+dataArt.urlToImage+')');

            data = data.append(container);
        }
        data.insertAfter(newsFound);
    }
    
    function createMsgTableTBody(res){
        
        let tbody = $('<tbody>');
        
        $.each(res, function(rol,d) {
            let row = '<tr>'+
            '<td> '+rol+ '</td>'+
            '<td>'+
                '<div class="progress">'+
                `<div class="progress-bar" role="progressbar" style="width:${d.perc}%;" aria-valuenow="${d.perc}" aria-valuemin="0" aria-valuemax="100">${d.perc}</div>`+
                '</div>'+
            '</td>'+
            `<td> ${d.cnt} </td>`+
            '</tr>';
            
            tbody.append(row);
        });
        
        return tbody;
    }

    let pending = $("#diaryAppointments").data("pending");
    let processed = $("#diaryAppointments").data("processed");

    $.ajax(_publicUrl + 'dashboard/fillMsgTable', {
        dataType: 'json',
        method:'get',
    }).done(function(res){
    $('#msgTable').find('tr:gt(0)').remove();
    let tbody = createMsgTableTBody(res);
    $(tbody).insertAfter('#msgTable thead');
    })
    .fail(function(xhr, st, err) {
        console.error("error in dashboard/fillMsgTable " + xhr, st, err);
    }); 

    $.ajax(_publicUrl + 'dashboard/fillDiaryAppointments', {
    dataType: 'json',
    method:'get',
    }).done(function(res){

    let diaryAppointments = document.getElementById('diaryAppointments').getContext('2d');
    let chart = new Chart(diaryAppointments, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            datasets: [{
                data: [res.pending, res.processed],

                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    ],
            }],    
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                pending,
                processed    
            ]
        },
    });

    })
    .fail(function(xhr, st, err) {
    console.error("error in dashboard/fillDiaryAppointments " + xhr, st, err);
    }); 


    $.ajax(_publicUrl + 'dashboard/fillDelayedAppointments', {
    dataType: 'json',
    method:'get',
    }).done(function(res){

    let laggardAppointments = document.getElementById('laggardAppointments').getContext('2d');
    let chart = new Chart(laggardAppointments, {
        // The type of chart we want to create
        type: 'pie',
        // The data for our dataset
        data: {
            datasets: [{
                // data: [15, 20],
                data: [res.pending, res.processed],

                backgroundColor: [
                    'rgb(238, 130, 238)',
                    'rgb(238, 238, 130)'
                ],
            }],    
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                pending,
                processed    
            ]
        },
    });

    })
    .fail(function(xhr, st, err) {
    console.error("error in dashboard/fillDelayedAppointments " + xhr, st, err);
    }); 


    $.ajax(_publicUrl + 'dashboard/fillWeekAppointments', {
    dataType: 'json',
    method:'get',
    }).done(function(res){
    let weekValue = res.map((week)=>week['value']);
    let weekName = res.map((week)=>week['weekName']);

    let mostWeekAppointments = document.getElementById('mostWeekAppointments').getContext('2d');
    let label = $("#mostWeekAppointments").data("label");
    let chart = new Chart(mostWeekAppointments, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: weekName,
            datasets: [{
            label: label,
            data: weekValue,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
            }]
        },
    });   

    })
    .fail(function(xhr, st, err) {
    console.error("error in dashboard/fillWeekAppointments " + xhr, st, err);
    }); 



    $.ajax(_publicUrl + 'dashboard/fillUsersTypeRoles', {
    dataType: 'json',
    method:'get',
    }).done(function(res){
        let roleNames = res.map((roles)=>roles['roles']['name']);
        let roleColors = res.map((roles)=>roles['color']);
        let roleTotals = res.map((roles)=>roles['total']);

        let usersTypeRoles = document.getElementById('usersTypeRoles').getContext('2d');
        let chart = new Chart(usersTypeRoles, {
            type: 'polarArea',
            data: {
                labels: roleNames,
                datasets: [{
                    label: 'Existing roles',
                    data: roleTotals,
                    backgroundColor: roleColors
                }]
                },
        });
    })
    .fail(function(xhr, st, err) {
        console.error("error in dashboard/fillUsersTypeRoles " + xhr, st, err);
    }); 



      $('#news-tab[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href");

        // Medical News API Usage: https://newsapi.org/s/us-health-news-api

        let articles =[];

        switch(flagLanguage){
                case "es":
                    fetch(_newsApiFirstPart+'ar'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataArgentina=>{
                    fetch(_newsApiFirstPart+'co'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataColombia=>{
                        articles=[...dataArgentina.articles,...dataColombia.articles]
                        createNewsCard(articles)
                        });
                    });
                    break;
                case "en":
                    fetch(_newsApiFirstPart+'us'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataUS=>{
                    fetch(_newsApiFirstPart+'gb'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataGB=>{
                    fetch(_newsApiFirstPart+'ie'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataIreland=>{
                    fetch(_newsApiFirstPart+'au'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataAustralia=>{
                        articles=[...dataUS.articles,...dataGB.articles,...dataIreland.articles,...dataAustralia.articles]
                        createNewsCard(articles)
                        });
                        });
                    });
                    });
                    break;
                case "it":
                    fetch(_newsApiFirstPart+'it'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(data=>{
                        articles=[...data.articles]
                        createNewsCard(articles)
                        });
                    break;
                default:
                fetch(_newsApiFirstPart+'ar'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataArgentina=>{
                    fetch(_newsApiFirstPart+'co'+_newsApiSecondPart)
                    .then(response=>response.json())
                    .then(dataColombia=>{
                        articles=[...dataArgentina.articles,...dataColombia.articles]
                        createNewsCard(articles)
                        });
                    });
                    break;
          }


      });

      $('#home-tab[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $("#newsContainer").remove();
      });

</script>
@endsection
