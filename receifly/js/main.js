$( document ).ready(function() {
    console.log("Hello");

    $('[data-toggle="tooltip"]').tooltip();

    $(".two-decimals").change(function(){
      this.value = parseFloat(this.value).toFixed(2);
    });

    $(document).on('keydown', '.two-decimal', function(e){
      var input = $(this);
      var oldVal = input.val();
      var regex = new RegExp(input.attr('pattern'), 'g');
    
      setTimeout(function(){
        var newVal = input.val();
        if(!regex.test(newVal)){
          input.val(oldVal); 
        }
      }, 0);
    });

    /*var $input = $("#merchantName");
    $input.typeahead({
    source: [
        {id: "WesternBeef", name: "Western Beef"},
        {id: "StopAndShop", name: "Stop and Shop"}
    ],
    autoSelect: true,
    items:5,
    addItem:'Add New Merchant'
    });
    $input.change(function() {
    var current = $input.typeahead("getActive");
    if (current) {
        // Some item from your model is active!
        if (current.name == $input.val()) {
        // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
        } else {
        // This means it is only a partial match, you can either add a new item
        // or take the active if you don't want new items
        }
    } else {
        // Nothing is active so it is a new value (or maybe empty value)
    }
    });*/

    /*var citynames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
          url: 'merchantNames.json',
          filter: function(list) {
            return $.map(list, function(cityname) {
              return { name: cityname }; });
          }
        }
      });
      citynames.initialize();
      
      $('#merchantName').tagsinput({
        typeaheadjs: {
          name: 'citynames',
          displayKey: 'name',
          valueKey: 'name',
          source: citynames.ttAdapter()
        }
      });*/

});