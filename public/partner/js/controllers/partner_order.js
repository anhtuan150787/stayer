$(function(){
    $('.order_detail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);

        $(".modal-body").html('<iframe style="width: 100%; border: none; height: 100%" src="' + button.data('url') + '"></iframe>');
    })
})