jQuery(function() {
  // MARK: URL取得
  let thisPageURL;
  const targetURL = [
    // ローカル環境URL
    "http://192.168.0.90:3000/",
    // ステージングURL
    "https://stg-hogehoge/",
    // 本番URL
    "https://prd-hogehoge/"
  ];
  $(window).on("load", function() {
    thisPageURL = $(location).attr("href");
  });

  let headerChangeThreshold;
  // URLでの場合分け
  $(window).on("load", function() {
    let isURLmatch = false;
    // targetURL配列に、現在のURLが含まれている場合の処理
    if (targetURL.includes(thisPageURL)) {
      isURLmatch = true;
    }
    // アンカーリンクにも適用する場合
    for (let i = 0; i < targetURL.length; i++) {
      let ankerURL = targetURL[i] + "#";
      if (thisPageURL.match(ankerURL)) {
        isURLmatch = true;
      }
    }
    if (isURLmatch) {
      headerChangeThreshold = 120;
    } else {
      headerChangeThreshold = 300;
    }
  });
  // ロード、スクロール時に何かする
  $(window).on("load scroll", function() {
    // PC,SPでhightに応じて変化させる場合
    const spBreakPoint = 768;
    let scrollY = window.pageYOffset; // 現在地
    let windowWidth = $(window).width();
    if (windowWidth <= spBreakPoint) {
      // SP時に変化させる高さ
      headerChangeThreshold = 1;
    } else {
      // PC時に変化させる高さ
      headerChangeThreshold = 120;
    }
    if (scrollY >= headerChangeThreshold) {
      $(".l-header").addClass("is-header-scrolled");
    } else {
      $(".l-header").removeClass("is-header-scrolled");
    }
    /*** END ***/
  });
});
