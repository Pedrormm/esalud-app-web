
@section('viewsScripts')

<script>

    let flagLanguage = $("#headerTopFlag").data("language");

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
        let maxNuberNews = {{ auth()->user()->news_number?auth()->user()->news_number:"5" }};
        maxNuberNews = parseInt(maxNuberNews);
        maxNuberNews = Number.isInteger(maxNuberNews)?maxNuberNews:5;
        for (let i=1;i<=maxNuberNews;i++){

            let dataArt = randomNoRepeats(arr)();
            // console.log("dataArt: ",dataArt);
            // console.log("array fuera ORIGINAL: ", arr);
            if (!dataArt){
                continue;
            }
            indexArticle++;

            let possibleImage = dataArt.urlToImage ? dataArt.urlToImage : (dataArt.image ? dataArt.image : "");

            let publishedDate = getLanguageDate(dataArt.publishedAt);

            dataArt.author = dataArt.author??"@lang('messages.news_anonymous')";

            let dataContent = (dataArt.content == null) ? '' : dataArt.content;
            let lastCharacterDescription = dataArt.description.slice(-1);
            dataContent = (lastCharacterDescription == ".") ? dataContent : lastCharacterDescription.concat(dataContent);
            let container = $('<div />').addClass("container py-5 jumbotron-container");
            let jumbotron = $('<div />').addClass("jumbotron text-white jumbotron-image shadow").attr('data-img', possibleImage);
            let jumbotronTitle = $('<h2 />').addClass("mb-4 p-3 bg-white opacity-4 shadow jumbotron-title text-dark").text(dataArt.title+".");
            
            let jumbotronContainerRow =  $('<div />').addClass("row");
            let jumbotronP = $('<p />').addClass("mb-4 jumbotron-text bg-white text-muted col-lg-8").text(dataArt.description +" "+ dataContent);
            let blockquote  = $('<blockquote />').addClass("mt-1 blockquote mb-0 blockquote-footer text-right").text("@lang('messages.news_source')");
            let blockquotecite = $('<cite />').attr('title', 'sample').text(dataArt.source.name);
            let jumbotronRightContainerRow = $('<p />').addClass("col-lg-4 jumbotron-container-right");
            let jumbotronInnerAuthor = $('<span />').addClass("font-italic").text(dataArt.author);
            let jumbotronAuthor = $('<p />').addClass("mb-4 jumbotron-author bg-white text-muted").text("@lang('messages.news_author')");
            let jumbotronInnerDate = $('<div />').addClass("jumbotron-inner-date font-italic").text(publishedDate);
            let jumbotronDate = $('<p />').addClass("mb-4 jumbotron-date bg-white text-muted").text("@lang('messages.news_published')");
            let jumbotronLinkContainer = $('<div />').addClass("text-center");
            let jumbotronLinkButton = $('<a />').addClass("btn btn-primary jumbotron-link").attr('href', dataArt.url).attr('target', "_blank").text("@lang('messages.news_link')");
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
            image.src= possibleImage;
          
            jumbotron.css('background-image', 'url('+_publicUrl+'images/clouds.jpg'+')');
            $(image).on("error", function () {
                jumbotron.css('background-image', 'url('+_publicUrl+'images/clouds.jpg'+')');
            });
            jumbotron.css('background-image', 'url('+possibleImage+')');

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

    @if (auth()->user()->role_id == \HV_ROLES::ADMIN)
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

            if ($("#usersTypeRoles").is(":visible")) {
                let usersTypeRoles = document.getElementById('usersTypeRoles').getContext('2d');
                let chart = new Chart(usersTypeRoles, {
                    type: 'polarArea',
                    data: {
                        labels: roleNames,
                        datasets: [{
                            label:  _messagesLocalization.existing_roles,
                            data: roleTotals,
                            backgroundColor: roleColors
                        }]
                        },
                });
            }
        })
        .fail(function(xhr, st, err) {
            console.error("error in dashboard/fillUsersTypeRoles " + xhr, st, err);
        }); 

    @elseif (auth()->user()->role_id == \HV_ROLES::PATIENT)
        {{-- Cantidad de citas pendientes vs citas aprobadas y rechazadas --}}

        let pending = $("#pendingAccptedRejectedAppointments").data("pending");
        let accepted = $("#pendingAccptedRejectedAppointments").data("accepted");
        let rejected = $("#pendingAccptedRejectedAppointments").data("rejected");

        $.ajax(_publicUrl + 'dashboard/fillSinglePatientAppointments', {
        dataType: 'json',
        method:'get',
        }).done(function(res){

        let singlePatientAppointments = document.getElementById('pendingAccptedRejectedAppointments').getContext('2d');
        let chart = new Chart(singlePatientAppointments, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                datasets: [{
                    data: [res.pending, res.accepted,res.rejected],

                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)'
                        ],
                }],    
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    pending,
                    accepted,
                    rejected
                ]
            },
        });

        })
        .fail(function(xhr, st, err) {
            console.error("error in dashboard/fillSinglePatientAppointments " + xhr, st, err);
        }); 

        {{-- Cantidad de tratamientos de curso vs total de tratamientos realizados --}}

        let progress = $("#treatmentsInProgress").data("progress");
        let finished = $("#treatmentsInProgress").data("finished");

        $.ajax(_publicUrl + 'dashboard/filltreatmentsInProgress', {
        dataType: 'json',
        method:'get',
        }).done(function(res){

        let treatmentsInProgress = document.getElementById('treatmentsInProgress').getContext('2d');
        let chart = new Chart(treatmentsInProgress, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                datasets: [{
                    data: [res.progress, res.finished],

                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                        ],
                }],    
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    progress,
                    finished
                ]
            },
        });

        })
        .fail(function(xhr, st, err) {
            console.error("error in dashboard/filltreatmentsInProgress " + xhr, st, err);
        }); 

    @elseif (auth()->user()->role_id == \HV_ROLES::DOCTOR)
        {{-- Frecuencia de citas, con respecto a sí mismo --}}
        {{-- Cantidad de citas con comentario vs sin comentario --}}

        {{-- Grafica de barras con los medicamentos mas usados, en funcion de todos los medicos --}}
        {{-- Modo de administracion de los medicamentos, en funcion de todos los medicos --}}
    @endif

      $('#news-tab[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href");

        // Medical News API Usage: https://newsapi.org/s/us-health-news-api

        let articles =[];

        switch(flagLanguage){
                case "es":
                    fetch(_newsApiFirstPart+'ar'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
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
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=es&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "en":
                    fetch(_newsApiFirstPart+'us'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
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
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=en&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "it":
                    fetch(_newsApiFirstPart+'it'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'it'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=it&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "pt":
                    fetch(_newsApiFirstPart+'pt'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'pt'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataPortugal=>{
                            fetch(_newsApiFirstPart+'br'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataBrazil=>{
                                articles=[...dataPortugal.articles,...dataBrazil.articles]
                                createNewsCard(articles)
                                });
                            });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=pt&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "fr":
                fetch(_newsApiFirstPart+'fr'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'fr'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataFrance=>{
                            fetch(_newsApiFirstPart+'be'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataBelgium=>{
                            fetch(_newsApiFirstPart+'ma'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataMorocco=>{
                                articles=[...dataFrance.articles,...dataBelgium.articles,...dataMorocco.articles]
                                createNewsCard(articles)
                                });
                            });
                            });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=fr&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "ro":
                fetch(_newsApiFirstPart+'ro'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'ro'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=ro&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "de":
                    fetch(_newsApiFirstPart+'de'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'de'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataGermany=>{
                            fetch(_newsApiFirstPart+'at'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataAustria=>{
                                articles=[...dataGermany.articles,...dataAustria.articles]
                                createNewsCard(articles)
                                });
                            });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=de&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "ar":
                    fetch(_newsApiFirstPart+'eg'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'eg'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=ar&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
                case "ru":
                    fetch(_newsApiFirstPart+'ru'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'ru'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=ru&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })  
                    break;
                case "zh_CN":
                    fetch(_newsApiFirstPart+'cn'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'cn'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataChina=>{
                            fetch(_newsApiFirstPart+'hk'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataHongKong=>{
                            fetch(_newsApiFirstPart+'tw'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(dataTaiwan=>{
                                articles=[...dataChina.articles,...dataHongKong.articles,...dataTaiwan.articles]
                                createNewsCard(articles)
                                });
                            });
                            });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=zh&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })  
                    break;
                case "ja":
                fetch(_newsApiFirstPart+'jp'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            fetch(_newsApiFirstPart+'jp'+_newsApiSecondPart)
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=ja&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })  
                    break;
                default:
                    fetch(_newsApiFirstPart+'ar'+_newsApiSecondPart)
                    .then(response=>{
                        if(response.status =="200"){
                            response.json();
                            console.log(response);
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
                        }
                        else{
                            fetch("https://gnews.io/api/v4/top-headlines?topic=health&lang=es&token=b9ddf00456cd2d6bf642f3894958f509")
                            .then(response=>response.json())
                            .then(data=>{
                                articles=[...data.articles]
                                createNewsCard(articles)
                                });
                        }
                    })                   
                    break;
          }


      });

      $('#home-tab[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $("#newsContainer").remove();
      });

</script>
@endsection
