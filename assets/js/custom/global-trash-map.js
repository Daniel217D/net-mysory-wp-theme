jQuery(async function ($) {
    $( '#top-menu [href="#"]' ).on( 'click', function (e){
        e.preventDefault();
        return false;
    } )

    const mapEl = document.getElementById('trash-global-map');

    if (!mapEl) {
        return;
    }

    let coordinates;

    try {
        coordinates = JSON.parse(sessionStorage.getItem('coordinates'));

        if (!coordinates) {
            throw 'empty coordinates'
        }
    } catch (e) {
        try {
            const coordinates_response = await fetch('http://ip-api.com/json');
            coordinates = (await coordinates_response.json())
            sessionStorage.setItem('coordinates', JSON.stringify(coordinates))
        } catch (e) {
            coordinates = {
                'lat': 0,
                'lon': 0
            }
        }
    }

    ymaps.ready(init);

    function init() {
        mapEl.classList.remove('loading');

        var myMap = new ymaps.Map('trash-global-map', {
            center: [coordinates['lat'], coordinates['lon']],
            zoom: 10,
            height: 100
        }, {
            searchControlProvider: 'yandex#search'
        });

        //https://yandex.ru/?z=15&text=51.650000%2C39.210000

        const clusterer = new ymaps.Clusterer({
            /**
             * Через кластеризатор можно указать только стили кластеров,
             * стили для меток нужно назначать каждой метке отдельно.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
             */
            preset: 'islands#redClusterIcons',
            /**
             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
             */
            groupByCoordinates: false,
            /**
             * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
             */
            clusterDisableClickZoom: false,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        })

        Object.values( window.trash_dots || {} ).forEach(function (dot) {
            try {
                clusterer.add(new ymaps.Placemark(dot.coordinates, {
                    iconContent: '',
                    iconCaption: dot.time,
                    hintContent: 'Подробнее',
                    balloonContentHeader:`<a href="${dot.link}" >${dot.title}</a>`,
                    balloonContentBody: `<a href="${dot.link}" ><img src="${dot.img}" style="width:140px;float: left; margin-right: 7px">${dot.desc}</a>`,
                    balloonContentFooter: dot.address,
                    balloonContent: `<div style="background-color: white;width: 100px;height: 100px;"></div>`
                }, {
                    preset: 'islands#icon',
                    iconColor: '#fb213c'
                }))
            } catch (e) {
                console.log(e)
            }
        })

        myMap.geoObjects.add(clusterer);

        myMap.controls.remove('trafficControl');
        myMap.controls.remove('searchControl');
        myMap.controls.remove('geolocationControl');
        myMap.controls.remove('toolBar');
        myMap.controls.remove('toolBarSeparator');
        myMap.controls.remove('typeSelector');

        if (coordinates.lat === 0 && coordinates.lon === 0) {
            myMap.setBounds(clusterer.getBounds(), {
                checkZoomRange: true
            });
        }

    }
})