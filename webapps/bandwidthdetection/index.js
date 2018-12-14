/* global XMLHttpRequest */
;(function () {
  var secondsEl = document.querySelector('.form--seconds-input')
  var timeoutEl = document.querySelector('.form--timeout-input')
  var formEl = document.querySelector('.form')
  var resultsEl = document.querySelector('.results')

  var checks = []
  var activeCheckAmount = 4
  var performingCheck = false

  formEl.addEventListener('submit', onSubmit)

  function onSubmit (e) {
    e.preventDefault()
    e.stopPropagation()

    resultsEl.innerHTML = 'Waiting for results...'

    performingCheck = true

    checks = []
    for (var i = 0; i < activeCheckAmount; i++) {
      createNewCheck()
    }

    setTimeout(waitForChecks, secondsEl.value * 1000)
  }

  function createNewCheck () {
    var req = new XMLHttpRequest()

    var idx = checks.length
    checks.push({
      req: req,
      start: Date.now(),
      end: 0,
      time: 0,
      response: '',
      bits: 0,
      state: 'active'
    })

    req.timeout = timeoutEl.value * 1000

    req.addEventListener('load', createCheckLoadListener(idx))
    req.addEventListener('timeout', createCheckTimeoutListener(idx))

    req.open('GET', 'http://localhost:5080/bandwidthdetection/download')
    req.send()
  }

  function createCheckTimeoutListener (idx) {
    return function () {
      var startDate = checks[idx].start
      var endDate = Date.now()
      var diff = endDate - startDate

      checks[idx].end = endDate
      checks[idx].time = diff
      checks[idx].state = 'timed out'

      if (performingCheck) {
        createNewCheck()
      }
    }
  }

  function createCheckLoadListener (idx) {
    return function () {
      var startDate = checks[idx].start
      var endDate = Date.now()
      var diff = endDate - startDate

      checks[idx].end = endDate
      checks[idx].time = diff
      checks[idx].response = this.responseText
      checks[idx].bits = this.responseText.length * 1000 * 8
      checks[idx].state = 'complete'

      if (performingCheck) {
        createNewCheck()
      }
    }
  }

  function waitForChecks () {
    performingCheck = false
    var activeChecks = checks.filter(function (x) { return x.state === 'active' })

    if (activeChecks.length) {
      window.requestAnimationFrame(waitForChecks)
      return
    }

    var goodChecks = checks.filter(function (x) { return x.state !== 'timed out' })

    var averageBits = goodChecks.reduce(function (c, n) {
      return c + n.bits
    }, 0) / goodChecks.length

    var averageTime = goodChecks.reduce(function (c, n) {
      return c + n.time
    }, 0) / goodChecks.length

    var bps = Math.round(averageBits / averageTime)
    var kbps = (bps / 1000).toFixed(2)
    var mbps = (kbps / 1000).toFixed(2)

    var byps = Math.round(bps / 8)
    var kbyps = (byps / 1024).toFixed(2)
    var mbyps = (kbps / 1024).toFixed(2)

    resultsEl.innerHTML = 'Bits/sec: ' + bps + '<br/>' +
      'Kb/sec: ' + kbps + '<br/>' +
      'Mb/sec: ' + mbps + '<br/>' +
      '<br/>' +
      'Bytes/sec: ' + byps + '<br/>' +
      'KB/sec: ' + kbyps + '<br/>' +
      'MB/sec: ' + mbyps
  }
})()
