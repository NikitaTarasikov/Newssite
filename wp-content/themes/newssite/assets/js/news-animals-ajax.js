let labels = document.querySelectorAll('#filter .news-filter__label');
labels.forEach((element) => {
  element.querySelector('input').addEventListener('click', () => {
    element.classList.toggle('active')
    element.querySelector('input').classList.toggle('active')
  })
})

let resetBtn = document.querySelector('.news-filter__inner-reset')
resetBtn.addEventListener('click', () => {
  labels.forEach((element) => {
    element.classList.remove('active')
    element.querySelector('input').classList.remove('active')
  })
  document.querySelector('.news-filter__label--all').classList.add('active')
  document.querySelector('.news-filter__label--all input').classList.add('active')
})

jQuery(function($) {
  let ajaxPaginationVar = '1';
  let filterVar = '';

  function ajaxPagination(id) {
    ajaxPaginationVar = id;

    $.ajax({
      url: newssite_news_animal_ajaxscript.ajaxurl,
      data: {
        'action': 'true_filter_function1',
        'paginationElement': ajaxPaginationVar,
        'filterArr': filterVar
      },
      method: 'post',
      beforeSend: function(xhr) {
        if(document.querySelector('.spinner-wrapper')){
          document.querySelector('.spinner-wrapper').classList.remove('none')
        }
      },
      success: function(data) {
        $('#response').html(data);
        if(document.querySelector('.spinner-wrapper')){
          document.querySelector('.spinner-wrapper').classList.add('none')
        }
        document.querySelectorAll('.news-pagination li').forEach((paginationElement) => {
          paginationElement.addEventListener('click', () => {
            ajaxPagination(paginationElement.getAttribute('id'));
          });
        });
      }
    });

    return false;
  }

  document.querySelectorAll('.news-pagination li').forEach((paginationElement) => {
    paginationElement.addEventListener('click', () => {
      ajaxPagination(paginationElement.getAttribute('id'));
    });
  });

  $('#filter').submit(function() {
    var filter = $(this);
    let filterInputs = document.querySelectorAll('#filter input.active');
    let filterArr = [];

    filterInputs.forEach((element) => {
      filterArr.push(element.getAttribute('name'));
    });

    filterVar = filterArr;

    $.ajax({
      url: newssite_news_animal_ajaxscript.ajaxurl,
      data: {
        'action': 'true_filter_function',
        'filterArr': filterVar,
        'paginationElement': ajaxPaginationVar,
      },
      type: filter.attr('method'),
      beforeSend: function(xhr) {
        filter.find('button').text('Uploading...');
      },
      success: function(data) {
        filter.find('button').text('Apply filter');
        $('#response').html(data);

        document.querySelectorAll('.news-pagination li').forEach((paginationElement) => {
          paginationElement.addEventListener('click', () => {
            ajaxPagination(paginationElement.getAttribute('id'));
          });
        });
      }
    });

    return false;
  });
});
