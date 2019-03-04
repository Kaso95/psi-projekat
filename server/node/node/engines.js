'use strict';

const fs = require('fs');
const path = require('path');
const O = require('../omikron');
const enginesData = require('./engines-data');

module.exports = getEngs();

function getEngs(){
  const data = enginesData;
  const {engines} = data;

  var obj = O.obj();

  engines.forEach(eng => {
    if(!eng.hasOwnProperty('script'))
      eng.script = `${data.mainScript}.${eng.ext}`;
    if(!eng.hasOwnProperty('ext'))
      eng.ext = eng.script.split('.').pop();
    if(!eng.hasOwnProperty('options'))
      eng.options = O.obj();

    obj[eng.name] = eng;
  });

  return obj;
}