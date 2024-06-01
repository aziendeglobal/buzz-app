/* globals Chart:false, feather:false */

(() => {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })


  new DataTable('#example', {
    language: {
      url: '/assets/js/datatable_es.json',
    },
    columns: [
      { width: '5%' }, { width: '15%' }, { width: '15%' }, { width: '30%' },  { width: '5%' }, { width: '10%' }, { width: '20%' }
    ]
  });

    

})()
