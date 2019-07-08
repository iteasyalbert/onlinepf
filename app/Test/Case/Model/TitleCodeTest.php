<?php
/* TitleCode Test cases generated on: 2012-12-12 05:15:20 : 1355289320*/
App::uses('TitleCode', 'Model');

/**
 * TitleCode Test Case
 *
 */
class TitleCodeTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.title_code', 'app.user', 'app.action_code', 'app.address', 'app.advertisement', 'app.categorie', 'app.category', 'app.post', 'app.post_content', 'app.image', 'app.post_tag', 'app.tag', 'app.reply', 'app.contact_information', 'app.corporate_account_address', 'app.corporate_account_contact_information', 'app.corporate_account', 'app.corporate_account_user', 'app.country_code', 'app.discount', 'app.identification_type', 'app.insurance_provider_product', 'app.insurance_provider', 'app.laboratory', 'app.laboratory_accepted_insurance', 'app.laboratory_address', 'app.laboratory_contact_information', 'app.laboratory_corporate_partner', 'app.laboratory_operating_hour', 'app.medical_report_template', 'app.member', 'app.package_detail', 'app.package_test_group', 'app.package', 'app.patient_batch_order_detail', 'app.patient_batch_order_discount', 'app.patient_batch_order_package', 'app.patient_batch_order', 'app.patient_order', 'app.patient', 'app.person', 'app.person_address', 'app.person_alias', 'app.person_contact_information', 'app.person_identification', 'app.person_identity', 'app.person_insurance', 'app.physician', 'app.privilege', 'app.provinces_states_code', 'app.provincial_region', 'app.street_code', 'app.suffix', 'app.test_convertion', 'app.test_group_detail', 'app.test_group_price', 'app.test_group', 'app.test_interpretation', 'app.test_order_audit_log', 'app.test_order_medical_report', 'app.test_order_package_medical_report', 'app.test_order_package', 'app.test_order_result', 'app.test_order', 'app.test_reference_range', 'app.test_set', 'app.testimonial', 'app.test', 'app.town_city_code', 'app.village_code', 'app.validating_user');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->TitleCode = ClassRegistry::init('TitleCode');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TitleCode);

		parent::tearDown();
	}

}
