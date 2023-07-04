@if($config['action']['active'])
    <script>
        // toggle status

        $(function () {
            preparedChangeStatus();
        });

        function preparedChangeStatus() {
            $('*[id^="chk_active_"]').change(function () {
                let id = $(this).prop('id').replace('chk_active_', '');
                let status = $(this).prop('checked');
                changeStatus(id, status);
            })
        }

        function changeStatus(id, status) {
            $.ajax({
                url: '{{ route($config['route'] . 'active', [session('shop')->slug]) }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    active: status
                },
                success: function (result) {
        
                }
            });
        }

    </script>
@endif
