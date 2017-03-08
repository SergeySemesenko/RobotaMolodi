<link href="{{ asset('/css/vacancies/vacanciesList.css') }}" rel="stylesheet">
<link href="{{ asset('/css/paginator/paginator.css') }}" rel="stylesheet">

<div class="test">
    @foreach($vacancies as $vacancy)
            <div>
                <div class="section">
                    <a class="links" href="/vacancy/{{$vacancy->id}}">
                        <h3>{{ $vacancy->position}}</h3>
                    </a>
                    <h4>
                        <strong>{{$vacancy->salary}} - {{$vacancy->salary_max}} {{$vacancy->Currency()[0]['currency']}}</strong>
                    </h4>
                    <p class="text-left"> {{strip_tags($vacancy->description)}} </p>
                </div>

                <a class="links" href="/vacancy/{{$vacancy->id}}">
                    <p class="read-next">Читати далі...</p>
                </a>

                <div class="below-section">
                    <span>{{ $vacancy->Company()->company_name}}</span>
                </div>

                <a class="links" href="#">
                    <div class="line">

                        <span class="town">@foreach($vacancy->Cities()->get() as $city){{ $city->name}} @endforeach</span>
                        <span class="drop">&bull;</span>
                        <span class="data">{{date('j m Y', strtotime($vacancy->updated_at))}}</span>
                    </div>
                </a>
                <hr>
            </div>
    @endforeach

    <div class="row paginatorr">
        <hr>
        @if($vacancies->lastPage() > 1)
            <div class="sort-by">
                <p class="pag-text">Показувати по:</p>
                <div class="pag-block-by no-active-pag-block">20</div>
                <div class="pag-block-by active-pag-block">50</div>
                <div class="pag-block-by no-active-pag-block">100</div>
            </div>
            @include('newDesign.default', ['paginator' => $vacancies])
{{--        {{ $vacancies -> links()}}--}}
        @endif
    </div>
</div>

<script>
    $(document).ready(function () {
        //paginate by N count
        $('.pag-block-by').click(function () {
            $('.active-pag-block').removeClass('active-pag-block');
            $(this).toggleClass('active-pag-block');
        })

        //filter
        function getFilters() {
            return {
                regions: $('select[name="selected-region"]').val(),
                industries: $('select[name="selected-indastry"]').val(),
                specialisations: $('select[name="selected-specialization"]').val(),
                sortDate: $('.opsion-sort-box').hasClass('active') ? 'asc' : 'desc'
            }
        }
        
        $('.getting-list-selected-box').on('change',function () {
            console.log('daadassas');
            $.ajax({
                url: '{{route('filter.vacancies')}}',
                data: getFilters(),
                success: function(data){
                    $('.test').html(data);
                }
            });
        })

        $('.opsion-sort-box').click(function () {
            console.log('daadassas');
//            if($(this).hasClass('active')){
//                $(this).removeClass('active');
//            }else{
//                $(this).addClass('active');
//            }
            $(this).toggleClass('active');
            $.ajax({
                url: '{{route('filter.vacancies')}}',
                data: getFilters(),
                success: function(data){
                    $('.test').html(data);
                }
            });
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function () {
        //paginate in ajax
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                getVacancies(url);
                window.history.pushState("", "", url);
            });
        function getVacancies(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.test').html(data);
                }).fail(function () {
                    alert('Vacancies could not be loaded.');
                });
        }
    });
</script>