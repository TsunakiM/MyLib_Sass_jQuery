jQuery(function() {
  // MARK: URL取得
  let thisPageURL;
  // ローカル環境URL
  const testURL = "http://192.168.0.90:3000/";
  // 本番環境URL
  const prodURL = "https://hogehoge";
  //
  $(window).load(function() {
    thisPageURL = $(location).attr("href");
    // console.log(thisPageURL);
  });

  // MARK: 特定のURL以外でクラスの着脱
  $(window).load(function() {
    if (thisPageURL === testURL || thisPageURL === prodURL) {
      $(".visible-control").addClass("visible");
    }
  });

  // MARK: 条件でクラスの着脱
  $(window).on("load scroll", function() {
    let headerChangeThreshold;

    // URLで変化させる場合
    if (thisPageURL === testURL || thisPageURL === prodURL) {
      headerChangeThreshold = 120;
    } else {
      headerChangeThreshold = 300;
    }

    // PC,SPで変化させる場合
    const spBreakPoint = 768;
    let scrollY = window.pageYOffset; // 現在地
    let windowWidth = $(window).width();
    if (windowWidth <= spBreakPoint) {
      // SP時に変化させる高さ
      heightThreshold = 1;
    } else {
      // PC時に変化させる高さ
      heightThreshold = 120;
    }

    if (scrollY >= headerChangeThreshold) {
      $(".l-header").addClass("is-header-scrolled");
    } else {
      $(".l-header").removeClass("is-header-scrolled");
    }
  });
});
