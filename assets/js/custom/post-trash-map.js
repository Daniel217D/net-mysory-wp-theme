jQuery(async function () {
    const mapEl = document.getElementById('map-in-post');

    if (!mapEl) {
        return;
    }

    let data;

    try {
        data = JSON.parse(mapEl.getAttribute('data-coords'))
    } catch (e) {
        data = ''
    }

    if (!data) {
        return;
    }

    ymaps.ready(function () {
        mapEl.classList.remove('loading');

        var myMap = new ymaps.Map('map-in-post', {
            center: data,
            zoom: 15
        }, {
            searchControlProvider: 'yandex#search'
        });

        myMap.behaviors.disable('drag')
        myMap.behaviors.disable('scrollZoom')
        myMap.behaviors.disable('routeEditor')
        myMap.behaviors.disable('ruler')
        myMap.behaviors.disable('multiTouch')
        myMap.behaviors.disable('dblClickZoom')
        myMap.behaviors.disable('leftMouseButtonMagnifier')
        myMap.behaviors.disable('rightMouseButtonMagnifier')
        myMap.controls.remove('trafficControl');
        myMap.controls.remove('searchControl');
        myMap.controls.remove('geolocationControl');
        myMap.controls.remove('toolBar');
        myMap.controls.remove('toolBarSeparator');
        myMap.controls.remove('typeSelector');

        myMap.geoObjects.add(new ymaps.Placemark(data, {
            iconContent: '',
        }, {
            preset: 'islands#icon',
            iconColor: '#fb213c'
        }))
    })
})