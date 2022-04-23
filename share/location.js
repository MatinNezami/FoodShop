(_ => {

    function get (key) {
        const match = (location.reference?? location.search).match(new RegExp(`${key}=.*`));
      
        if (!match) return "";
        
        let end = match[0].search('&');
        if (end < 0) end = undefined;
        
        return match[0].slice(match[0].search('=') + 1, end);
    }

    location.get = get;


    function remove (...keys) {
        let querys = location.reference?? location.search;

        for (const key of keys)
            querys = querys.replaceAll((querys.match(new RegExp(`${key}=[^&]*&?`))?? [''])[0], "");

        if (querys.endsWith("&"))
            querys = querys.slice(0, -1);

        return querys == '?'? "": querys;
    }

    location.remove = remove;


    function set (keys) {
        let querys = location.reference?? location.search;

        for (const key in keys) {
            if (!querys.includes(key)) continue;

            const query = location.search.match(new RegExp(`${key}=[^&]*`)),
                replaced = key + (keys[key]? '=' + keys[key]: "");

            if (!query) querys = querys.replace(key, replaced);
            else querys = querys.replace(query[0], replaced);
        }

        return querys;
    }

    location.set = set;


    function append (querys) {
        let base = location.reference?? location.search;
            search = base? base + '&': '?';

        for (const query in querys)
            search += query + (querys[query]? '=' + querys[query]: "");

        return search;
    }

    location.append = append;


    location.unset = _ => location.reference = undefined;

})()