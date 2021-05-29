<script>
    // const _PUBLIC_URL = "{{ url('') }}";
    let _publicUrl = location.href.includes('public') ? location.href.substring(0, location.href.indexOf('public')+7):
        location.href.match(/^(http(s)?:\/\/([^\/$]+))/);
    if (!location.href.includes('public')){
        _publicUrl = _publicUrl[0].lastIndexOf("/") !== _publicUrl[0].length - 1 ? (_publicUrl[0] + "/") : _publicUrl[0] ;
    }    
    const _avoidAllSendings = false;

    const _flagUrl = "https://lipis.github.io/flag-icon-css/flags/4x3/";
    const _newsApiKey = "97e0683efdc3495883496dc2330ef7b4"
    let _lang = "{{ \HV_LANGUAGE::getLang() }}";
    let _longLang = "{{ \HV_LANGUAGE::getLangLong() }}";
    let _urlDtLang = "//cdn.datatables.net/plug-ins/1.10.20/i18n/"+_longLang+".json";
    let _newsApiFirstPart = "https://newsapi.org/v2/top-headlines?country=";
    let _newsApiSecondPart = "&category=health&apiKey="+_newsApiKey;
    let _questionMarkSpConcat = _lang=='es' ? '¿' : '';
    let _base64Avatar = "";
    let _messagesLocalization = @json($messagesLocalization);
    let _weekNameDays = (Object.values(_messagesLocalization.weekMap));
</script>