@section ('footer')
    <footer id="footer">
        <span class="copyright">
            <?php echo "Copyright ©". date('Y') ." ポケモン【剣盾】育成論投稿サイト All Rights Reserved."; ?>
        </span>
    </footer>

    @if (Auth::check())
    <script>
        jQuery(function() {
            $('.good-btn').click(function() {
                const dataId = $(this).data('id');

                const addGoodUrl = `/good/theory/${dataId}`;
                const removeGoodUrl = `/good/theory/remove/${dataId}`;

                const isGood = $(this).hasClass('add-good');

                const changeCountEl = (data, dataId) => {
                    let count = data['good_count'];
                    $('.count-' + dataId).html(count);
                }

                if ( !(isGood)) {
                    $.ajax({
                        type: 'POST',
                        url: addGoodUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType:'json',
                        context: this,
                    })
                    .done(function(data) {
                        $(this).toggleClass('add-good');
                        changeCountEl(data, dataId);
                    })
                    .fail(function() {
                        console.log('error');
                    })
                }
                else {
                    $.ajax({
                        type: 'POST',
                        url: removeGoodUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            '_method': 'DELETE',
                        },
                        dataType: 'json',
                        context: this,
                    })
                    .done(function(data) {
                        $(this).toggleClass('add-good');

                        let count = $('.count-' + dataId).text();

                        if (count === 1) {
                            $('.count-' + dataId).html('');
                        }
                        else {
                            changeCountEl(data, dataId);
                        }

                    })
                    .fail(function() {
                        console.log('error');
                    })
                }

            });
        });
    </script>
    @endif
@endsection
