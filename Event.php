<?php

namespace App\Nova;

use App\Nova\Metrics;
use Arsenaltech\NovaHeader\NovaHeader;
use Arsenaltech\NovaTab\NovaTab;
use Fourstacks\NovaRepeatableFields\Repeater;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Event extends Resource {
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = 'App\Event';

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'id';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'name',
	];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function fields(Request $request) {

		return [
			new NovaTab('Request Form', $this->requestForm()),
			new NovaTab('Programme', $this->programmeDetails()),
			new NovaTab('Logistics', $this->logisticsDetails()),
			new NovaTab('Attendees', $this->attendeesDetails()),
			new NovaTab('Before and After Photos', $this->beforeAndAfterImagesDetails()),
		];
	}

	/**
	 * Get the cards available for the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function cards(Request $request) {
		return [new Metrics\EventsThisMonth];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function filters(Request $request) {
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function lenses(Request $request) {
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function actions(Request $request) {
		return [];
	}

	public function title() {
		return $this->name;
	}

	public function requestForm() {
		return [

			Text::make('Event Name', 'name')
				->sortable()
				->rules('required', 'max:255'),
			Date::make('Start Date')->firstDayOfWeek(1),
			Date::make('End Date')->firstDayOfWeek(1),
			Select::make('Nature of Event')->options([
				'congress' => 'Congress',
				'workshop' => 'Workshop',
				'one-on-one' => 'One-on-one',
				'other' => 'Others',
			])->hideFromIndex(),
			Select::make('Event Type')->options([
				'symposium' => 'Symposium',
				'new_user' => 'New User',
				'train_the_trainer' => 'Train the trainer',
				'launch_event' => 'Launch Event / PR',
				'webinar' => 'Webinar',
				'other' => 'Other',
			]),
			Select::make('Company')->options([
				'austramedex' => 'Austramedex',
				'daewoong' => 'Daewoong',
				'parvus' => 'Parvus',
				'pt pharmindo' => 'PT. Pharmindo',

			]),
//			Text::make('Speaker'),
			Text::make('City'),
			Text::make('Country')->hideFromIndex(),
			Text::make('Expected Audience')->hideFromIndex(),
			Text::make('Expected Attendance')->hideFromIndex(),
			Text::make('Comments')->hideFromIndex(),
			BelongsTo::make('Trainer', 'trainer', 'App\Nova\User'),
		];
	}

	public function programmeDetails() {
		return [
			Repeater::make('Schedule')->displayStackedForm()->hideFromIndex()
				->addField([
					'label' => 'Start Time',
					'name' => 'start_time',
				])
				->addField([
					'label' => 'End Time',
					'name' => 'end_time',
				])
				->addField([
					'label' => 'Format Focus',
					'name' => 'format_focus',
				])
				->addField([
					'label' => 'Speaker',
					'name' => 'speaker',
				]),
		];
	}

	public function logisticsDetails() {
		return [
			Repeater::make('Logistics')->displayStackedForm()->hideFromIndex()
				->addField([
					'label' => 'Flight Type',
					'name' => 'flight_type',
				])
				->addField([
					'label' => 'Flight Number',
					'name' => 'flight_number',
				])
				->addField([
					'label' => 'Flight Date',
					'name' => 'flight_date',
				])
				->addField([
					'label' => 'Flight Time',
					'name' => 'flight_time',
				])
				->addField([
					'label' => 'Passenger Name',
					'name' => 'passenger_name',
				])
				->addField([
					'label' => 'Hotel Information and confirmation',
					'name' => 'hotel_info',
				]),
		];
	}

	public function attendeesDetails() {

		return [

			Repeater::make('Attendees')->displayStackedForm()->hideFromIndex()
				->addField([
					'label' => 'Attendee Name',
					'name' => 'attendee_name',
				])
				->addField([
					'label' => 'Specialty',
					'name' => 'specialty',
				])
				->addField([
					'label' => 'Email',
					'name' => 'email',
					'type' => 'email',
				])
				->addField([
					'label' => 'Experience with Silhouette',
					'name' => 'experience_silhouette',
				])
				->addField([
					'label' => 'Experience with Ellanse',
					'name' => 'experience_ellanse',
				])
				->addField([
					'label' => 'Experience with Perfectha',
					'name' => 'experience_perfectha',
				]),
		];
	}

	public function beforeAndAfterImagesDetails() {
		$before_images = [

			Image::make('Left Oblique'),
		];

		$after_images = [
			Image::make('Right Oblique'),
		];

		return [
			// Heading::make('<p>Hello World</p>')->asHtml(),
			NovaHeader::make('Before'),
			Image::make('Left Profile 90º')->hideFromIndex(),
			Image::make('Left Oblique 45º')->hideFromIndex(),
			Image::make('Frontal 0º')->hideFromIndex(),
			Image::make('Right Oblique 45º')->hideFromIndex(),
			Image::make('Right Profile 90º')->hideFromIndex(),

			NovaHeader::make('After'),
			Image::make('Left Profile 90º')->hideFromIndex(),
			Image::make('Left Oblique 45º')->hideFromIndex(),
			Image::make('Frontal 0º')->hideFromIndex(),
			Image::make('Right Oblique 45º')->hideFromIndex(),
			Image::make('Right Profile 90º')->hideFromIndex(),

		];
	}
}
