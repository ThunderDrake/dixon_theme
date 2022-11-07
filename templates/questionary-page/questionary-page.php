<?php 
/**
 * The template for displaying the questionary page.
 *
 * @package dixon_theme
 */
get_header();
$vacancy_array = get_field('vacancy_list', get_page_id_by_slug('vacancy'));
$total_array = [];
foreach ($vacancy_array as $vacancy) {
	foreach ($vacancy['sub_vacancy'] as $subvacancy) {
		$total_array[] = $subvacancy;
	}
}
?>
<main class="main" style="padding-top: var(--header-height);">
      <section class="questionary">
  <div class="questionary__container container">
    <h1 class="questionary__title h2-title">Анкета соискателя</h1>
    <div class="questionary__content">
      <div class="questionary__subtitle">Заполните поля анкеты, и нажмите «Отправить»</div>
      <form class="questionary__form" id="questionary_form">
        <div class="questionary__form-subtitle">Укажите информацию о себе</div>
        <label class="questionary__item-select questionary__item--split">
          <span>Должность</span>
          <select class="questionary__select" name="position">
			<?php foreach($total_array as $vacancy): ?>
				<option value="<?= $vacancy['list_name'] ?>"><?= $vacancy['list_name'] ?></option>
			<?php endforeach; ?>
          </select>
        </label>
        <label class="questionary__item">
          <input class="questionary__input questionary__input--name" type="text" name="name">
          <span class="questionary__item-placeholder questionary__item-placeholder--required">Ваши Ф.И.О</span>
        </label>
        <label class="questionary__item">
          <input class="questionary__input questionary__input--phone" type="tel" name="phone">
          <span class="questionary__item-placeholder questionary__item-placeholder--required">Телефон</span>
        </label>
        <label class="questionary__item">
          <input class="questionary__input questionary__input--birthday" type="text" name="birthday">
          <span class="questionary__item-placeholder questionary__item-placeholder--required">Дата рождения</span>
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder questionary__item-placeholder--required">Гражданство</span>
          <input class="questionary__input questionary__input--citizenship" type="text" name="citizenship">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Семейное положение</span>
          <input class="questionary__input questionary__input--marital" type="text" name="marital_status">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Дети</span>
          <input class="questionary__input questionary__input--babes" type="text" name="babes">
        </label>
        <div class="questionary__form-subtitle">Укажите данные об образовании и работе</div>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Образование</span>
          <input class="questionary__input questionary__input--education" type="text" name="education">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Год окончания обучения</span>
          <input class="questionary__input questionary__input--education-end" type="text" name="education_end">
        </label>
        <label class="questionary__item-select">
          <select class="questionary__select" name="education_position" placeholder="Форма обучения">
            <option placeholder>Форма обучения</option>
            <option value="Среднее">Среднее</option>
            <option value="Высшее бакалавриат">Высшее бакалавриат</option>
            <option value="Высшее магистратура">Высшее магистратура</option>
          </select>
        </label>
		<input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>
		<input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Укажите последнее место работы</span>
          <input class="questionary__input questionary__input--last-work" type="text" name="last_work">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Должность</span>
          <input class="questionary__input questionary__input--last-position" type="text" name="last_position">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Период работы</span>
          <input class="questionary__input questionary__input--last-work-time" type="text" name="last_work_time">
        </label>
        <div class="questionary__form-subtitle">Работаете ли Вы сейчас?</div>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Ожидаемый уровень дохода</span>
          <input class="questionary__input questionary__input--money" type="text" name="money">
        </label>
        <label class="questionary__item">
          <span class="questionary__item-placeholder">Когда готовы приступить к работе?</span>
          <input class="questionary__input questionary__input--work-start" type="text" name="work_start">
        </label>
        <button type="submit" class="questionary__submit btn btn--main btn-reset">Отправить</button>
        <div class="questionary__policy">Нажимая на кнопку, я принимаю условия соглашения на обработку моих персональных данных <span>*</span></div>
      </form>
    </div>
  </div>
</section>

    </main>
<?php get_footer(); ?>