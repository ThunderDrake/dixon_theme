(function() {
  var ItemPage;

  ItemPage = (function() {
    function ItemPage() {
      this.configure();
      this.init();
      return this;
    }
    ItemPage.prototype.configure = function() {
      this.cc = $('.cart-controls', '#main.product-page');
      this.add = $('[data-cart="add"]', this.cc);
      this.add_item = $('[data-cart="add_item"]', this.cc);
      this.minus_item = $('[data-cart="minus_item"]');
      this.gallery = $('.product-info-content-gallery-wrapper');
      this.gallery_images = $('.product-info-content-gallery-images', this.gallery);
      this.gallery_thumbnails = $('.product-info-content-gallery-thumbnails', this.gallery);
      this.tabs = $('[data-node="tabs"]');
      this.tabs_togglers = $('[data-tabs-toggler]', this.tabs);
      //this.tabs_blocks = $('[data-tabs-block]', this.tabs);
      //this.review_form = $('#commentform');
      //this.review_form_toggle = $('#reply-title');
      //this.rating = $('.comment-form-rating');
      //this.rating_stars = $('input', this.rating);
      this.related = $('[data-swiper="related"]');
      return this.upsells = $('[data-swiper="upsells"]');
    };


ItemPage.prototype.init = function() {
    this.initButtons();
    this.initGallery();
}
ItemPage.prototype.initButtons = function() {
  var IP;
  IP = this;
  this.add.on('click', function() {
    var action, data;
    data = {
      'product_id': IP.cc.data('product_id'),
      'product_sku': IP.cc.data('product_sku'),
      'quantity': 1
    };
    action = 'add_to_cart';
    return IP.addToCart(data, action);
  });
  this.add_item.on('click', function() {
    var action, data;
    data = {
      'product_id': IP.cc.data('product_id'),
      'product_sku': IP.cc.data('product_sku'),
      'quantity': 1,
      'quick_buy': true
    };
    action = 'quick_buy';
    return IP.colItemProduct(data, action);
  });
  return this.minus_item.on('change', function() {
    var data;
    data = {
      'product_id': IP.cc.data('product_id')
    };
    return IP.colItemProduct(data,action);
  });
};
