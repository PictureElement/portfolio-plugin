$(window).on('load', function() {

    // Masonry options
    var masonryOptions = {
        columnWidth: '.portfolio-list__sizer',
        itemSelector: '.portfolio-list__item',
        gutter: '.portfolio-list__gutter-sizer',
        percentPosition: true,
        horizontalOrder: true
    };
    
    // Initialize Masonry
    var $grid = $('#portfolioListStage').masonry(masonryOptions);
    
    $('.portfolio-list__category').on('click', function() {
        
        var $this =  $(this);
        
        categoryId = $this.attr('id').replace('portfolioListCategory-','');
        //console.log(categoryId);
        
        $('#portfolioListStageLoader').addClass('portfolio-list__stage-loader_show');
        
        $.request('PortfolioList::onFilter', {
            data: {
                categoryId: categoryId
            },
            complete: function() {
                $('#portfolioListStage').addClass('portfolio-list__stage_hide');
                
                $grid.imagesLoaded( function() {
                    // Destroy Masonry
                    $grid.masonry('destroy');
                    
                    // Re-initialize
                    $grid.masonry(masonryOptions);
                    
                    // Update selected filter
                    $('.portfolio-list__category_selected').removeClass('portfolio-list__category_selected');
                    $this.addClass('portfolio-list__category_selected');
                    
                    $('#portfolioListStageLoader').removeClass('portfolio-list__stage-loader_show');
                    $('#portfolioListStage').removeClass('portfolio-list__stage_hide');
                });
            }
        });
        
    });

    $('#portfolioListStage').on('click', '.portfolio-list__link', function() {
        projectId = this.id.replace('portfolioListLink-','');
        //console.log(projectId);
    
        var instance = $.fancybox.open({
            src: '#portfolioListModal',
            beforeShow: function() {
                $('#portfolioListModal').removeClass('portfolio-list__modal_show');
            },
            afterShow: function() {
                $('#portfolioListModalSpinner').addClass('portfolio-list__modal-spinner_show');
                
                $.request('PortfolioList::onModal', {
                    data: {
                        projectId: projectId
                    },
                    complete: function() {
                        $('#portfolioListModalText').imagesLoaded( function() {
                            $('#portfolioListModalSpinner').removeClass('portfolio-list__modal-spinner_show');
                            $('#portfolioListModal').addClass('portfolio-list__modal_show');
                        });
                    }
                });
            }
        });
    });
});