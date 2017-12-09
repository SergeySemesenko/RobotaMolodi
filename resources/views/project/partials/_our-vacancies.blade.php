<section class="our-vacancies">
    <div class="our-vacancies__title">
        <div class="our-vacancies__title-text">Наші вакансії на проект</div>
    </div>
    <ul class="our-vacancies__list">
        @foreach($vacancies as $vacancy)
        <li class="our-vacancies__items">
            <div class="our-vacancies__items-title">
                <h2 class="our-vacancies__items-title-main">{{ $vacancy->name }}</h2>
                <div class="our-vacancies__items-title-total">
                    (Total: {{ $vacancy->total }} vacancies. Vacant: <span class="total-text">{{ $vacancy->free }} vacancy.</span>)
                </div>
            </div>
            <div class="our-vacancies__items-text">
                {{  $vacancy->description }}
            </div>
            <ul class="our-vacancies__skills">
                <li class="our-vacancies__skills-items">
                    <div class="skills__items-title">Essential skills:</div>
                    <ul class="skills__items-list">
                        @foreach($vacancy->getEssentialSkills() as $s)
                            <li class="skills__items-skill">{{ $s->value }}</li>
                        @endforeach
                    </ul>
                </li>
                <li class="our-vacancies__skills-items">
                    <div class="skills__items-title">Personal skills:</div>
                    <ul class="skills__items-list">
                        @foreach($vacancy->getPersonalSkills() as $s)
                            <li class="skills__items-skill">{{ $s->value }}</li>
                        @endforeach
                    </ul>
                </li>
                <li class="our-vacancies__skills-items">
                    <div class="skills__items-title">Would be a good plus:</div>
                    <ul class="skills__items-list">
                        @foreach($vacancy->getBePlus() as $s)
                            <li class="skills__items-skill">{{ $s->value }}</li>
                        @endforeach
                    </ul>
                </li>
                <li class="our-vacancies__skills-items">
                    <div class="skills__items-title">What’s in it for you?</div>
                    <ul class="skills__items-list">
                        @foreach($vacancy->getForYou() as $s)
                            <li class="skills__items-skill">{{ $s->value }}</li>
                        @endforeach
                    </ul>
                </li>
                <li class="our-vacancies__skills-items">
                    <div class="skills__items-title">Responsibilities:</div>
                    <ul class="skills__items-list">
                        <li class="skills__items-skill">Requirements analysis and processing</li>
                        @foreach($vacancy->getResponsibilities() as $s)
                            <li class="skills__items-skill">{{ $s->value }}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="our-vacancies__links">
                <li class="our-vacancies__links-wrapper">
                    <a href="#" class="our-vacancies__links-link"><i class="fa fa-link" aria-hidden="true"></i>Вiдправити URL</a>
                </li>
                <li class="our-vacancies__links-wrapper">
                    <a href="#" class="our-vacancies__links-link"><i class="fa fa-file-o" aria-hidden="true"></i>Вiдправити файл</a>
                </li>
                <li class="our-vacancies__links-wrapper">
                    <a href="#" class="our-vacancies__links-link"><i class="fa fa-file-text-o" aria-hidden="true"></i>Вiдправити резюме</a>
                </li>
                <li class="our-vacancies__links-wrapper">
                    <a href="#" class="our-vacancies__links-link"><i class="fa fa-check-square-o" aria-hidden="true"></i>Підписатись на вакансію</a>
                </li>
            </ul>
            <div class="our-vacancies__curtail-expand clearfix">
                <a href="#" class="our-vacancies__curtail-expand__link dropdown">
                    <span class="caret"></span> розгорнути
                </a>
            </div>
        </li>
        @endforeach
    </ul>
</section>
