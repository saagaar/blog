/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// import fontawesome from '@fortawesome/fontawesome-free/js/all.js';

require('./bootstrap');
window.Vue = require('vue');
import VueWordCloud from 'vuewordcloud';
Vue.component(VueWordCloud.name, VueWordCloud);
import VProgressBar from './components/VProgressBar';
Vue.component('v-progress-bar', VProgressBar);
// import Vuelidate from 'vuelidate'
// Vue.use(Vuelidate);
// Vue.use(window.Vuelidate.default)

/**
Custom Imports goes here
*/
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('top-nav', require('./components/TopNav/TheTopNav.vue').default);
// Vue.component('main-nav', require('./components/MainNav/TheMainNav.vue').default);
// Vue.component('footer', require('./components/Footer/Footer.vue').default);

// Vue.component('Home', require('./components/Home.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var svgNS = 'http://www.w3.org/2000/svg';


const app = new Vue({
    el: '#landing-page',
    data: function() {
            return {
                animation: undefined,
                animationDurationValueIndex: 1,
                animationDurationValues: [0, 1000, 5000, 10000],
                animationEasing: undefined,
                animationEasingValues: [
                    'ease',
                    'linear',
                    'ease-in',
                    'ease-out',
                    'ease-in-out',
                    'cubic-bezier(0.1,0.7,1.0,0.1)',
                ],
                animationItems: [
                    {
                        text: 'bounce',
                        value: ['bounceIn', 'bounceOut'],
                    },
                    {
                        text: 'fade',
                        value: ['fadeIn', 'fadeOut'],
                    },
                    {
                        text: 'flipX',
                        value: ['flipInX', 'flipOutX'],
                    },
                    {
                        text: 'flipY',
                        value: ['flipInY', 'flipOutY'],
                    },
                    {
                        text: 'rotate',
                        value: ['rotateIn', 'rotateOut'],
                    },
                    {
                        text: 'zoom',
                        value: ['zoomIn', 'zoomOut'],
                    },
                ],
                animationOverlapValueIndex: 1,
                animationOverlapValues: [0, 1/5, 1/2, 1],
                colorItemIndex: undefined,
                colorItems: [
                    // ['#d99cd1', '#c99cd1', '#b99cd1', '#a99cd1'],
                    // ['#403030', '#f97a7a'],
                    ['#31a50d', '#d1b022', '#74482a','#779cc1'],
                    // ['#ffd077', '#3bc4c7', '#3a9eea', '#ff4e69', '#461e47'],
                ],
                drawer: true,
                fontFamily: undefined,
                fontFamilyValues: [
                    'Abril Fatface',
                    'Anton',
                    'Bahiana',
                    'Merienda',
                    'Quicksand',
                    // 'Abril Fatface',
                    // 'Annie Use Your Telescope',
                    // 'Anton',
                    // 'Bahiana',
                    // 'Baloo Bhaijaan',
                    // 'Barrio',
                    // 'Finger Paint',
                    // 'Fredericka the Great',
                    // 'Gloria Hallelujah',
                    // 'Indie Flower',
                    // 'Life Savers',
                    // 'Londrina Sketch',
                    // 'Love Ya Like A Sister',
                    // 'Merienda',
                    // 'Nothing You Could Do',
                    // 'Pacifico',
                    // 'Quicksand',
                    // 'Righteous',
                    // 'Sacramento',
                    // 'Shadows Into Light',
                ],
                fontSizeRatioValueIndex: 0,
                fontSizeRatioValues: [0, 1/20, 1/5, 1/2, 1],
                progress: undefined,
                progressVisible: true,
                rotationItemIndex: undefined,
                rotationItemsprogressVisible: [
                    {
                        value: 0,
                        svg: (function() {
                            var div = document.createElement('div');
                            div.appendChild((function() {
                                var svg = document.createElementNS(svgNS, 'svg');
                                svg.setAttribute('viewBox', '0 0 12 12');
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    return path;
                                })());
                                return svg;
                            })());
                            return URL.createObjectURL(new Blob([div.innerHTML]));
                        })(),
                    },
                    {
                        value: 7/8,
                        svg: (function() {
                            var div = document.createElement('div');
                            div.appendChild((function() {
                                var svg = document.createElementNS(svgNS, 'svg');
                                svg.setAttribute('viewBox', '0 0 12 12');
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    path.setAttribute('transform', 'rotate(315 6 6)');
                                    return path;
                                })());
                                return svg;
                            })());
                            return URL.createObjectURL(new Blob([div.innerHTML]));
                        })(),
                    },
                    {
                        value: function(word) {
                            var chance = new Chance(word[0]);
                            return chance.pickone([0, 3/4]);
                        },
                        svg: (function() {
                            var div = document.createElement('div');
                            div.appendChild((function() {
                                var svg = document.createElementNS(svgNS, 'svg');
                                svg.setAttribute('viewBox', '0 0 12 12');
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    return path;
                                })());
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    path.setAttribute('transform', 'rotate(90 6 6)');
                                    return path;
                                })());
                                return svg;
                            })());
                            return URL.createObjectURL(new Blob([div.innerHTML]));
                        })(),
                    },
                    {
                        value: function(word) {
                            var chance = new Chance(word[0]);
                            return chance.pickone([0, 1/8, 3/4, 7/8]);
                        },
                        svg: (function() {
                            var div = document.createElement('div');
                            div.appendChild((function() {
                                var svg = document.createElementNS(svgNS, 'svg');
                                svg.setAttribute('viewBox', '0 0 12 12');
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    return path;
                                })());
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    path.setAttribute('transform', 'rotate(45 6 6)');
                                    return path;
                                })());
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    path.setAttribute('transform', 'rotate(90 6 6)');
                                    return path;
                                })());
                                svg.appendChild((function() {
                                    var path = document.createElementNS(svgNS, 'path');
                                    path.setAttribute('d', 'M0 7 L0 5 L12 5 L12 7 Z');
                                    path.setAttribute('transform', 'rotate(315 6 6)');
                                    return path;
                                })());
                                return svg;
                            })());
                            return URL.createObjectURL(new Blob([div.innerHTML]));
                        })(),
                    },
                    {
                        value: function(word) {
                            var chance = new Chance(word[0]);
                            return chance.random();
                        },
                        svg: (function() {
                            var div = document.createElement('div');
                            div.appendChild((function() {
                                var svg = document.createElementNS(svgNS, 'svg');
                                svg.setAttribute('viewBox', '0 0 2 2');
                                svg.appendChild((function() {
                                    var circle = document.createElementNS(svgNS, 'circle');
                                    circle.setAttribute('cx', 1);
                                    circle.setAttribute('cy', 1);
                                    circle.setAttribute('r', 1);
                                    return circle;
                                })());
                                return svg;
                            })());
                            return URL.createObjectURL(new Blob([div.innerHTML]));
                        })(),
                    }
                ],
                snackbarText: '',
                snackbarVisible: false,
                spacingValueIndex: 1,
                spacingValues: [0, 1/4, 1/2, 1, 2],
                wordsText: undefined,
            };
        },
        computed: {
            animationDuration: function() {
                return this.animationDurationValues[this.animationDurationValueIndex];
            },

            animationOverlap: function() {
                return this.animationOverlapValues[this.animationOverlapValueIndex];
            },

            color: function() {
                var colors = this.colorItems[this.colorItemIndex];
                return function() {
                    return chance.pickone(colors);
                };
            },

            enterAnimation: function() {
                return 'animated bounceIn';
                return ['animated', this.animation[0]].join(' ');
            },

            fontSizeRatio: function() {
                return this.fontSizeRatioValues[this.fontSizeRatioValueIndex];
            },

            leaveAnimation: function() {
                return ['animated', this.animation[1]].join(' ');
            },

            rotation: function() {
                var item = this.rotationItemsprogressVisible[this.rotationItemIndex];
                //change shaope of cloud
                var item = this.rotationItemsprogressVisible[2];

                return item.value;
            },

            spacing: function() {
                return this.spacingValues[this.spacingValueIndex];
            },

            words: function() {
                  let allCategory = JSON.parse(window.__allCategory__) || {};
                  // var res=Object.keys(allCategory).map(function(key) { 
                    let allcat=[];
                    var tempcat;
                    // console.log(key);
                    allCategory.forEach(function(v,i){  
                        tempcat=v.split(/[\r\n]+/)
                            .map(function(line) {
                                return /^(.+)\s+(-?\d+)$/.exec(line);
                            })
                            .filter(function(matched) {
                                return matched;
                            })
                            .map(function(matched) {
                                var text = matched[1];
                                var weight = Number.parseInt(matched[2]);
                                return [text, weight];

                            }); 
                     allcat.push(tempcat[0]);

                    });
                   return allcat;
            },
        },

        watch: {
            progress: function(currentProgress, previousProgress) {
                if (previousProgress) {
                    this.progressVisible = false;
                }
            },
        },

        created: function() {
            this.generateWordsText();
            this.animation = chance.pickone(this.animationItems).value;
            this.animationEasing = chance.pickone(this.animationEasingValues);
            this.colorItemIndex = chance.integer({min: 0, max: this.colorItems.length - 1});
            this.fontFamily = chance.pickone(this.fontFamilyValues);
            this.rotationItemIndex = chance.integer({min: 0, max: this.rotationItemsprogressVisible.length - 1});
        },

        methods: {
            generateWordsText: function() {
                this.wordsText = [
                    [9, 1, 3],
                    [4, 5, 15],
                    [2, 5, 15],
                    [1, 25, 150],
                ]
                    .reduce(function(returns, item) {
                        var weight = item[0];
                        var minCount = item[1];
                        var maxCount = item[2];
                        var count = chance.integer({min: minCount, max: maxCount});
                        chance.n(function() {
                            var word = chance.word();
                            returns.push(word+' '+weight);
                        }, count);
                        return returns;
                    }, [])
                    .join('\n');
            },

            loadFont: function(fontFamily, fontStyle, fontWeight, text) {
                return (new FontFaceObserver(fontFamily, {style: fontStyle, weight: fontWeight})).load(text);
            },

            onWordClick: function(word) {
                this.snackbarVisible = true;
                this.snackbarText = word[0];
            },
        },

});
