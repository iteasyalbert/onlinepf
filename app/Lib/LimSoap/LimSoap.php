<?php
class LimSoap {
	static $debug=true;
	
	static function addComplexType($server, $complexName=null)
	{
		//Definition of types must be forward relation parents must be defined first
		
		$types = array();
		$types['AccessToken'] = array(
				'AccessToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'result' => array('name' => 'Result', 'type' => 'xsd:int'),
			    	'token' => array('name' => 'Token', 'type' => 'xsd:string')
			    ),
			    null,
			    null,
			    null
			);
		
		$types['ExecutionToken'] =array(
				'ExecutionToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'token' => array('name' => 'token', 'type' => 'xsd:string'),
			    	'random' => array('name' => 'random', 'type' => 'xsd:string'),
			    	'datetime' => array('name' => 'datetime', 'type' => 'xsd:dateTime')
			    ),
			    null,
			    null,
			    null
			);
			
		$types['ResultToken']=array(
				'ResultToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'status' => array('name' => 'status', 'type' => 'xsd:int'), //0 - fail //1 - success
			    	'token' => array('name' => 'token', 'type' => 'xsd:string'),
			    	'random' => array('name' => 'random', 'type' => 'xsd:string'),
			    	'datetime' => array('name' => 'datetime', 'type' => 'xsd:dateTime')
			    ),
			    null,
			    null,
			    null
			);
			
		$types['EducationLevel']=array(
			    'EducationLevel',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);

		$types['EducationLevels']= array(
				'EducationLevel',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:EducationLevel[]')
		 		),
		 		'tns:EducationLevel',
		 		null
			);
			
		$types['EducationDegree']=array(
			    'EducationDegree',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['EducationDegrees'] = array(
				'EducationDegrees',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:EducationDegree[]')
		 		),
		 		'tns:EducationDegree',
		 		null
			);
			
		$types['Service']=array(
			    'Service',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'type' => array('name' => 'Type', 'type' => 'xsd:int'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
		
		
		$types['Services'] = array(
				'Services',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Service[]')
		 		),
		 		'tns:Service',
		 		null
			);
			
		$types['Accreditation']=array(
			    'Accreditation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Accreditations'] = array(
				'Accreditations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Accreditation[]')
		 		),
		 		'tns:Accreditation',
		 		null
			);
			
		$types['EducationCourse'] = array(
			    'EducationCourse',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['EducationCourses'] = array(
				'EducationCourses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:EducationCourse[]')
		 		),
		 		'tns:EducationCourse',
		 		null
			);
			
		$types['Profession']=array(
			    'Profession',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Professions'] = array(
				'Professions',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Profession[]')
		 		),
		 		'tns:Profession',
		 		null
			);
			
		$types['EducationCourseProfession']=array(
			    'EducationCourseProfession',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'EducationCourse'=> array('name' => 'EducationCourse', 'type' => 'tns:EducationCourse'),
			    	'Profession'=> array('name' => 'Profession', 'type' => 'tns:Profession'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['EducationCourseProfessions']= array(
				'EducationCourseProfessions',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:EducationCourseProfession[]')
		 		),
		 		'tns:EducationCourseProfession',
		 		null
			);
			
		$types['Industry']=array(
			    'Industry',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'health_risk_rating' => array('name' => 'HealthRiskRating','type'=>'xsd:int'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Industries']= array(
				'Industries',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Industry[]')
		 		),
		 		'tns:Industry',
		 		null
			);
			
		$types['StreetCode']=array(
			    'StreetCode',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Address']=array(
			    'Address',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'floor' => array('name' => 'Floor', 'type' => 'xsd:string'),
			    	'unit' => array('name' => 'Unit', 'type' => 'xsd:string'),
			    	'building_apartment' => array('name' => 'BuildingApartment', 'type' => 'xsd:string'),
			    	'street_number' => array('name' => 'StreetNumber','type'=>'xsd:string'),
			    	'street_id' => array('name' => 'StreetId','type'=>'xsd:long'),
			    	'lot' => array('name' => 'Lot','type'=>'xsd:string'),
			    	'block' => array('name' => 'Block','type'=>'xsd:string'),
			    	'StreetCode' => array('name' => 'StreetCode', 'type' => 'tns:StreetCode'),
			    	'village_id' => array('name' => 'VillageId','type'=>'xsd:long'),
			    	'town_city_id' => array('name' => 'TownCityId','type'=>'xsd:long'),
			    	'province_state_id' => array('name' => 'ProvinceStateId','type'=>'xsd:long'),
			    	'country_id' => array('name' => 'CountryId','type'=>'xsd:long'),
			    	'longitude' => array('name' => 'Longitude','type'=>'xsd:decimal'),
			    	'latitude' => array('name' => 'Latitude','type'=>'xsd:decimal'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Addresses']=array(
				'Addresses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Address[]')
		 		),
		 		'tns:Address',
		 		null
			);
			
		$types['IdentificationType']=array(
			    'IdentificationType',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'type' => array('name' => 'StreetNumber','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['IdentificationTypes']=array(
				'IdentificationTypes',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:IdentificationType[]')
		 		),
		 		'tns:IdentificationType',
		 		null
			);
			
		$types['ContactInformation']=array(
			    'ContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'type' => array('name' => 'Floor', 'type' => 'xsd:int'),
			    	'contact' => array('name' => 'Contact', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['ContactInformations']=array(
				'ContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:ContactInformation[]')
		 		),
		 		'tns:ContactInformation',
		 		null
			);
			
		$types['Company']=array(
				'Company',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'type' => array('name' => 'type', 'type' => 'xsd:int'), //1 - single, 2 - partnership, 3 - corporation
			    	'Industry' => array('name' => 'Industry', 'type' => 'tns:Industry'),
			    	'website' => array('name' => 'Website', 'type' => 'xsd:string'),
			    	'logo' => array('name' => 'Logo', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Companies']=array(
				'Companies',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Company[]')
		 		),
		 		'tns:Company',
		 		null
			);
			
		$types['CompanyBranch']=array(
				'CompanyBranch',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'Company' => array('name' => 'Company', 'type' => 'tns:Company'),
			    	'Laboratory' => array('name' => 'Laboratory', 'type' => 'tns:Laboratory'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranches']=array(
				'CompanyBranches',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranch[]')
		 		),
		 		'tns:CompanyBranch',
		 		null
			);
			
		$types['CompanyBranchInfo']=array(
				'CompanyBranchInfo',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'logo' => array('name' => 'Logo', 'type' => 'xsd:string'),
					'mission' => array('name' => 'Mission', 'type' => 'xsd:string'),
			    	'vision' => array('name' => 'Vision', 'type' => 'xsd:string'),
			    	'website' => array('name' => 'Website', 'type' => 'xsd:string'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
		
		$types['CompanyBranchInfoList']=array(
				'CompanyBranchInfoList',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchInfo[]')
		 		),
		 		'tns:CompanyBranchInfo',
		 		null
			);
			
		$types['CompanyBranchContactInformation']=array(
			    'CompanyBranchContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'ContactInformation' => array('name'=>'ContactInformation','type'=>'tns:ContactInformation'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchContactInformations']=array(
				'CompanyBranchContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchContactInformation[]')
		 		),
		 		'tns:CompanyBranchContactInformation',
		 		null
			);
			
		$types['CompanyBranchAddress']=array(
			    'CompanyBranchAddress',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'Address' => array('name'=>'Address','type'=>'tns:Address'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchAddresses']=array(
				'CompanyBranchAddresses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchAddress[]')
		 		),
		 		'tns:CompanyBranchAddress',
		 		null
			);
			
		$types['CompanyBranchOperatingHour']=array(
			    'CompanyBranchOperatingHour',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'day' => array('name' => 'Day', 'type' => 'xsd:int'),
			    	'start_time' => array('name' => 'StartIme', 'type' => 'xsd:time'),
			    	'end_time' => array('name' => 'EndTime', 'type' => 'xsd:time'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchOperatingHours']=array(
				'CompanyBranchOperatingHours',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchOperatingHour[]')
		 		),
		 		'tns:CompanyBranchOperatingHour',
		 		null
			);
			
		$types['CompanyBranchService']=array(
			    'CompanyBranchService',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'Service' => array('name'=>'Service','type'=>'tns:Service'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchServices']=array(
				'CompanyBranchServices',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchService[]')
		 		),
		 		'tns:CompanyBranchService',
		 		null
			);
			
		$types['CompanyBranchAccreditation']=array(
			    'CompanyBranchAccreditation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'Accreditation' => array('name'=>'Accreditation','type'=>'tns:Accreditation'),
			    	'accreditation_id' => array('name'=>'AccreditationId','type'=>'xsd:long'),
			    	'accreditation_number' => array('name' => 'AccreditationNumber', 'type' => 'xsd:string'),
			    	'accreditation_date' => array('name' => 'AccreditationDate', 'type' => 'xsd:dateTime'),
			    	'accreditation_renewal_date' => array('name' => 'AccreditationRenewalDate', 'type' => 'xsd:dateTime'),
			    	'accreditation_expiration_date' => array('name' => 'AccreditationExpirationDate', 'type' => 'xsd:dateTime'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchAccreditations']=array(
				'CompanyBranchAccreditations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchAccreditation[]')
		 		),
		 		'tns:CompanyBranchAccreditation',
		 		null
			);
			
		$types['User']=array(
				'User',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'username' => array('name' => 'Username', 'type' => 'xsd:string'),
			    	'password' => array('name' => 'Password', 'type' => 'xsd:string'),
			    	'role' => array('name' => 'Role', 'type' => 'xsd:int'),
			    	'last_login_datetime' => array('name' => 'LastLoginDatetime', 'type' => 'xsd:dateTime'),
			    	'status' => array('name' => 'Status', 'type' => 'xsd:int'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	'PersonIdentity' => array('type'=>'tns:PersonIdentities'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Person']=array(
				'Person',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'myresultonline_id' => array('name' => 'MyresulonlineId', 'type' => 'xsd:string'),
			    	'title_id' => array('name' => 'TitleId', 'type' => 'xsd:long'),
			    	'lastname' => array('name' => 'Lastname', 'type' => 'xsd:string'),
			    	'firstname' => array('name' => 'Firstname', 'type' => 'xsd:string'),
			    	'middlename' => array('name' => 'Middlename', 'type' => 'xsd:string'),
			    	'maidenname' => array('name' => 'Maidenname', 'type' => 'xsd:string'),
			    	'nickname' => array('name' => 'Maidenname', 'type' => 'xsd:string'),
			    	'suffix_id' => array('name' => 'SuffixId', 'type' => 'xsd:long'),
			    	'birthdate' => array('name' => 'Birthdate', 'type' => 'xsd:dateTime'),
			    	'sex' => array('name' => 'Sex', 'type' => 'xsd:string'),
			    	'marital_status' => array('name' => 'MaritalStatus', 'type' => 'xsd:string'),
			    	'father_person_id' => array('name' => 'FatherPersonId', 'type' => 'xsd:long'),
			    	'mother_person_id' => array('name' => 'MotherPersonId', 'type' => 'xsd:long'),
			    	'living_status' => array('name' => 'LivingStatus', 'type' => 'xsd:int'),
			    	'record_status' => array('name' => 'RecordStatus', 'type' => 'xsd:int'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	'checksum' => array('name' => 'Checksum', 'type' => 'xsd:string')
			    ),
			    null,
			    null,
			    null
			);
			
		$types['People']=array(
				'People',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Person[]')
		 		),
		 		'tns:Person',
		 		null
			);
			
		$types['PersonIdentity']=array(
			    'PersonIdentity',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'users_id' => array('name' => 'UsersId', 'type' => 'xsd:long'),
			    	'User' => array('name' => 'User', 'type' => 'tns:User'),
			    	'person_id' => array('name' => 'PersonId', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'default' => array('name' => 'Default', 'type' => 'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonIdentities']=array(
				'PersonIdentities',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonIdentity[]')
		 		),
		 		'tns:PersonIdentity',
		 		null
			);
			
		$types['PersonIdentification']=array(
			    'PersonIdentification',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'IdentificationType' => array('name' => 'IdentificationType', 'type' => 'tns:IdentificationType'),
			    	'expiration_date' => array('name' => 'ExpirationDate', 'type' => 'xsd:dateTime'),
			    	'reference_number' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'remarks' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'image' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonIdentifications']=array(
				'PersonIdentifications',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonIdentification[]')
		 		),
		 		'tns:PersonIdentification',
		 		null
			);
			
		$types['PersonAddress']=array(
			    'PersonAddress',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'person_id' => array('name' => 'PersonId', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'address_id'  => array('name' => 'PersonId', 'type' => 'xsd:long'),
			    	'Address' => array('name' => 'Address', 'type' => 'tns:Address'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonAddresses']=array(
				'PersonAddresses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonAddress[]')
		 		),
		 		'tns:PersonAddress',
		 		null
			);
			
		$types['Patient']=array(
				'Patient',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:string'),
			    	'person_id' => array('name' => 'PersonId', 'type' => 'xsd:long'),
			    	'registered_date' => array('name' => 'RegisteredDate', 'type' => 'xsd:string'),
			    	'registered_time' => array('name' => 'RegisteredTime', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	'checksum' => array('name' => 'Checksum', 'type' => 'xsd:string')
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Patients']=array(
				'Patients',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Patient[]')
		 		),
		 		'tns:Patient',
		 		null
			);
			
		$types['School']=array(
			    'School',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'Id', 'type' => 'tns:CompanyBranch'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	'Address' => array('name'=>'Address','type'=>'tns:Address'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Schools']=array(
				'Schools',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:School[]')
		 		),
		 		'tns:School',
		 		null
			);
			
		$types['PersonEducationalBackground']=array(
			    'PersonEducationalBackground',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'School'=> array('name' => 'Id', 'type' => 'tns:School'),
			    	'start_date_coverage' => array('name' => 'StartDateCoverage', 'type' => 'xsd:dateTime'),
			    	'end_date_coverage' => array('name' => 'EndDateCoverage', 'type' => 'xsd:dateTime'),
			    	'education_level_id' => array('name' => 'EducationLevelId', 'type' => 'xsd:long'),
			    	'education_degree_id' => array('name' => 'EducationDegreeId', 'type' => 'xsd:long'),
			    	'education_major_id' => array('name' => 'EducationMajorId', 'type' => 'xsd:long'),
			    	'education_minor_id' => array('name' => 'EducationMinorId', 'type' => 'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonEducationalBackgrounds']=array(
				'PersonEducationalBackgrounds',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonEducationalBackground[]')
		 		),
		 		'tns:PersonEducationalBackground',
		 		null
			);
			
		$types['PersonAlias']=array(
			    'PersonAlias',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'PersonAlias' => array('name' => 'PersonAlias', 'type' => 'tns:Person'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonAliases']=array(
				'PersonAliases',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonAlias[]')
		 		),
		 		'tns:PersonAlias',
		 		null
			);
			
		$types['PersonContactInformation']=array(
			    'PersonContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'person_id'  => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name'=>'Person','type'=>'tns:Person'),
			    	'contact_id'  => array('name' => 'ContactId', 'type' => 'xsd:long'),
			    	'ContactInformation' => array('name'=>'ContactInformation','type'=>'tns:ContactInformation'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonContactInformations']=array(
				'PersonContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonContactInformation[]')
		 		),
		 		'tns:PersonContactInformation',
		 		null
			);
			
			//Todo: Insurance Provider Product
			//Todo: Insurance Provider
		$types['PersonInsurance']=array(
			    'PersonInsurance',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'person_id'  => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'insurance_provider_product_id' => array('name'=>'InsuranceProviderProductId','type'=>'xsd:long'),
			    	'insurance_number' => array('name'=>'InsuranceNumber','type'=>'xsd:string'),
			    	'effectivity_date' => array('name'=>'EffectivityDate','type'=>'xsd:dateTime'),
			    	'expiration_date' => array('name'=>'ExpirationDate','type'=>'xsd:dateTime'),
			    	'limit_details' => array('name'=>'LimitDetails','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonInsurances']=array(
				'PersonInsurances',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonInsurance[]')
		 		),
		 		'tns:PersonInsurance',
		 		null
			);
		
		$types['PersonMark']=array(
				'PersonMark',
				'complexType',
				'struct',
				'sequence',
				'',
				array(
						'id' => array('name' => 'Id', 'type' => 'xsd:long'),
						'person_id'  => array('name' => 'Id', 'type' => 'xsd:long'),
						'type'  => array('name' => 'Type', 'type' => 'xsd:int'),
						'finger'  => array('name' => 'Finger', 'type' => 'xsd:int'),
						'description' => array('name'=>'Description','type'=>'xsd:string'),
						'filename' => array('name'=>'Filename','type'=>'xsd:string'),
						'default' => array('name' => 'Default', 'type' => 'xsd:boolean'),
						'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
						'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
						'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
						'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
				),
				null,
				null,
				null
		);
			
		$types['PersonMarks']=array(
				'PersonMarks',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
				array(),
				array(
						array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonMark[]')
				),
				'tns:PersonMark',
				null
		);
		
		$types['PersonMarkImage']=array(
				'PersonMarkImage',
				'complexType',
				'struct',
				'sequence',
				'',
				array(
						'id' => array('name' => 'Id', 'type' => 'xsd:long'),
						'part' => array('name' => 'Id', 'type' => 'xsd:int'),
						'image' => array('name'=>'Filename','type'=>'xsd:string'),
				),
				null,
				null,
				null
		);
			
		$types['PersonDetail']=array(
			    'PersonDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'PersonAddress' => array('name'=>'person_addresses','type'=>'tns:PersonAddresses'),
			    	'PersonContactInformation' => array('name'=>'person_contact_informations','type'=>'tns:PersonContactInformations'),
			    	'PersonIdentification' => array('name'=>'person_identifications','type'=>'tns:PersonIdentifications'),
			    	'PersonInsurance' => array('name'=>'person_insurances','type'=>'tns:PersonInsurances'),
			    	'PersonMark' => array('name'=>'person_marks','type'=>'tns:PersonMarks'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonDetails']=array(
				'PersonDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonDetail[]')
		 		),
		 		'tns:PersonDetail',
		 		null
			);
			
		$types['UserIdentities']=array(
				'UserIdentities',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'PersonIdentity' => array('type'=>'tns:PersonIdentities'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchMember']=array(
				'CompanyBranchMember',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name'=>'Id','type'=>'xsd:long'),
			    	'company_branch_id' => array('name' => 'CompanyBranchId', 'type' => 'xsd:long'),
			    	'CompanyBranch' => array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'users_id' => array('name' => 'UsersId', 'type' => 'xsd:long'),
			    	'User' => array('name' => 'User', 'type' => 'tns:User'),
			    	'role' => array('name' => 'Username', 'type' => 'xsd:int'),
			    	'enabled' => array('name' => 'Enabled', 'type' => 'xsd:boolean'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyBranchMembers']=array(
				'CompanyBranchMembers',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyBranchMember[]')
		 		),
		 		'tns:CompanyBranchMember',
		 		null
			);
			
		$types['Laboratory']=array(
				'Laboratory',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranch'=> array('name' => 'CompanyBranch', 'type' => 'tns:CompanyBranch'),
			    	'type' => array('name' => 'Type', 'type' => 'xsd:int'),
			    	'class' => array('name' => 'Class', 'type' => 'xsd:int'),
			    	'status' => array('name' => 'Username', 'type' => 'xsd:int'),
					'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Laboratories']=array(
				'Laboratories',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Laboratory[]')
		 		),
		 		'tns:Laboratory',
		 		null
			);
			
		$types['LaboratoryAcceptedInsurance']=array(
			    'LaboratoryAcceptedInsurance',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'insurance_provider_product_id' => array('name' => 'InsuranceProviderProductId', 'type' => 'xsd:long'),
			    	'remarks' => array('name' => 'Remarks', 'type' => 'xsd:string'),
			    	'validity_start_date' => array('name' => 'ValidityStartDate', 'type' => 'xsd:dateTime'),
			    	'validity_end_date' => array('name' => 'ValidityEndDate', 'type' => 'xsd:dateTime'),
			    	'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryAcceptedInsurances']=array(
				'LaboratoryAcceptedInsurances',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryAcceptedInsurance[]')
		 		),
		 		'tns:LaboratoryAcceptedInsurance',
		 		null
			);
			
		$types['CompanyDetail']=array(
			    'CompanyDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyBranchInfo' => array('name'=>'CompanyBranchServices','type'=>'tns:CompanyBranchInfo'),
			    	'CompanyBranchAddress' => array('name'=>'CompanyBranchAddress','type'=>'tns:CompanyBranchAddresses'),
			    	'CompanyBranchContactInformation' => array('name'=>'CompanyBranchContactInfomation','type'=>'tns:CompanyBranchContactInformations'),
			    	'CompanyBranchService' => array('name'=>'CompanyBranchServices','type'=>'tns:CompanyBranchServices'),
			    	'CompanyBranchOperatingHour' => array('name'=>'CompanyBranchServices','type'=>'tns:CompanyBranchOperatingHours'),
			    	'CompanyBranchAccreditation' => array('name'=>'CompanyBranchServices','type'=>'tns:CompanyBranchAccreditations'),
			    	//'LaboratoryAcceptedInsurance' => array('name'=>'LaboratoryAcceptedInsurance','type'=>'tns:LaboratoryAcceptedInsurances'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['CompanyDetails']=array(
				'CompanyDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:CompanyDetail[]')
		 		),
		 		'tns:CompanyDetail',
		 		null
			);
			
		$types['LaboratoryDetail']=array(
			    'LaboratoryDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'CompanyDetail'=>array('Name'=>'CompanyDetail','type' => 'tns:CompanyDetail')
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryDetails']=array(
				'LaboratoryDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryDetail[]')
		 		),
		 		'tns:LaboratoryDetail',
		 		null
			);
			
		$types['UserResult']=array(
			    'UserResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'User' => array('name' => 'User', 'type' => 'tns:User'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['UserIdentitiesResult']=array(
			    'UserIdentitiesResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'UserIdentities' => array('name' => 'User', 'type' => 'tns:UserIdentities'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonResult']=array(
			    'PersonResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PersonDetailResult']=array(
			    'PersonDetailResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'PersonDetail' => array('name' => 'PersonDetail', 'type' => 'tns:PersonDetail'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['MembershipsResult']=array(
			    'MembershipsResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'CompanyBranchMembers' => array('name' => 'CompanyBranchMembers', 'type' => 'tns:CompanyBranchMembers'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryResult']=array(
			    'LaboratoryResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'Laboratory' => array('name' => 'Laboratory', 'type' => 'tns:Laboratory'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryDetailResult']=array(
			    'LaboratoryDetailResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'LaboratoryDetail' => array('name' => 'LaboratoryDetail', 'type' => 'tns:LaboratoryDetail'),
			    ),
			    null,
			    null,
			    null
			);
			
		

		$types['BeginLimPosting']=array(
			    'BeginLimPosting',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'session_id' => array('name' => 'SessionId', 'type' => 'xsd:string'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['BeginLimPostingResult']=array(
			    'BeginLimPostingResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'BeginLimPosting' => array('name' => 'BeginLimPosting', 'type' => 'tns:BeginLimPosting'),
			    ),
			    null,
			    null,
			    null
			);
			
		
		$types['EndResultPosting']=array(
			    'EndResultPosting',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:string'),
			    ),
			    null,
			    null,
			    null
			);
		
		$types['EndLimPostingResult']=array(
			    'EndLimPostingResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'EndLimPostingResult' => array('name' => 'EndLimPostingResult', 'type' => 'tns:EndLimPostingResult'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Physician']=array(
			    'Physician',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'users_id' => array('name' => 'UsersId', 'type' => 'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Physicians']=array(
				'Physicians',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Physician[]')
		 		),
		 		'tns:Physician',
		 		null
			);
			
		$types['PhysicianProfile']=array(
			    'PhysicianProfile',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'physician_id' => array('name' => 'PhysicianId', 'type' => 'xsd:long'),
			    	'key_competencies' => array('name' => 'KeyCompetencies', 'type' => 'xsd:string'),
			    	'practice_profile' => array('name' => 'PracticeProfile', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['PhysicianProfiles']=array(
				'PhysicianProfiles',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PhysicianProfile[]')
		 		),
		 		'tns:PhysicianProfile',
		 		null
			);
			
		$types['LaboratoryTest']=array(
			    'LaboratoryTest',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'standard_test_id' => array('name' => 'StandardTestId', 'type' => 'xsd:string'),
			    	'laboratory_id' => array('name' => 'LaboratoryId', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTests']=array(
				'LaboratoryTests',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTest[]')
		 		),
		 		'tns:LaboratoryTest',
		 		null
			);
			
		$types['LaboratoryTestSet']=array(
			    'LaboratoryTestSet',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'laboratory_id' => array('name' => 'LaboratoryId', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'default' => array('name' => 'Default','type'=>'xsd:boolean'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestSets']=array(
				'LaboratoryTestSets',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestSet[]')
		 		),
		 		'tns:LaboratoryTestSet',
		 		null
			);
			
		$types['LaboratoryTestConvertion']=array(
			    'LaboratoryTestConvertion',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_set_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'unit_type' => array('name' => 'UnitType', 'type' => 'xsd:int'),
			    	'si_convertion_factor' => array('name' => 'SiConvertionFactor', 'type' => 'xsd:decimal'),
			    	'conventional_convertion_factor' => array('name' => 'ConventionalConvertionFactor', 'type' => 'xsd:decimal'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestConvertions']=array(
				'LaboratoryTestConvertions',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestConvertion[]')
		 		),
		 		'tns:LaboratoryTestConvertion',
		 		null
			);
			
		$types['LaboratoryTestReferenceRange']=array(
			    'LaboratoryTestReferenceRange',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_set_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'sex' => array('name' => 'Sex', 'type' => 'xsd:string'),
			    	'start_age' => array('name' => 'StartAge', 'type' => 'xsd:decimal'),
			    	'end_age' => array('name' => 'EndAge', 'type' => 'xsd:decimal'),
			    	'si_reference_range' => array('name' => 'SiReferenceRange', 'type' => 'xsd:string'),
			    	'si_unit' => array('name' => 'SiUnit', 'type' => 'xsd:string'),
			    	'conventional_reference_range' => array('name' => 'ConventionalReferenceRange', 'type' => 'xsd:string'),
			    	'conventional_unit' => array('name' => 'ConventionalUnit', 'type' => 'xsd:string'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestReferenceRanges']=array(
				'LaboratoryTestReferenceRanges',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestReferenceRange[]')
		 		),
		 		'tns:LaboratoryTestReferenceRange',
		 		null
			);
			
		$types['LaboratoryTestInterpretation']=array(
			    'LaboratoryTestInterpretation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_set_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'sex' => array('name' => 'Sex', 'type' => 'xsd:string'),
			    	'age_condition' => array('name' => 'AgeCondition', 'type' => 'xsd:int'),
			    	'start_age' => array('name' => 'StartAge', 'type' => 'xsd:decimal'),
			    	'end_age' => array('name' => 'EndAge', 'type' => 'xsd:decimal'),
			    	'start_result' => array('name' => 'StartResult', 'type' => 'xsd:decimal'),
			    	'end_result' => array('name' => 'EndResult', 'type' => 'xsd:decimal'),
			    	'user_cut_off' => array('name' => 'UseCutOff', 'type' => 'xsd:boolean'),
			    	'cut_off_value' => array('name' => 'CutOffValue', 'type' => 'xsd:decimal'),
			    	'flag' => array('name' => 'Flag', 'type' => 'xsd:string'),
			    	'web_patient_viewable' => array('name' => 'WebPatientViewable', 'type' => 'xsd:boolean'),
			    	'web_physician_viewable' => array('name' => 'WebPhysicianViewable', 'type' => 'xsd:boolean'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestInterpretations']=array(
				'LaboratoryTestInterpretations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestInterpretation[]')
		 		),
		 		'tns:LaboratoryTestInterpretation',
		 		null
			);
			
		$types['LaboratoryTestGroup']=array(
			    'LaboratoryTestGroup',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'standard_test_group_id' => array('name' => 'StandardTestGroupId', 'type' => 'xsd:string'),
			    	'laboratory_id' => array('name' => 'LaboratoryId', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:string'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'primary' => array('name' => 'Primary','type'=>'xsd:boolean'),
			    	'primary_test_group_id' => array('name' => 'PrimaryTestGroupId', 'type' => 'xsd:long'),
			    	'default' => array('name' => 'Default','type'=>'xsd:boolean'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestGroups']=array(
				'LaboratoryTestGroups',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestGroup[]')
		 		),
		 		'tns:LaboratoryTestGroup',
		 		null
			);
			
		$types['LaboratoryTestGroupPrice']=array(
			    'LaboratoryTestGroupPrice',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_group_id' => array('name' => 'TestGroupId', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'priority' => array('name' => 'Priority', 'type' => 'xsd:int'),
			    	'validity_start_datetime' => array('name' => 'ValidityStartDatetime', 'type' => 'xsd:dateTime'),
			    	'validity_end_datetime' => array('name' => 'ValidityEndDatetime', 'type' => 'xsd:dateTime'),
			    	'price' => array('name' => 'Price','type'=>'xsd:decimal'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestGroupPrices']=array(
				'LaboratoryTestGroupPrices',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestGroupPrice[]')
		 		),
		 		'tns:LaboratoryTestGroupPrice',
		 		null
			);
			
		$types['LaboratoryTestGroupDetail']=array(
			    'LaboratoryTestGroupDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_group_id' => array('name' => 'TestGroupId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'specimen_type' => array('name' => 'SpecimenType', 'type' => 'xsd:int'),
			    	'result_type' => array('name' => 'ResultType', 'type' => 'xsd:int'),
			    	'test_set_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'display_order' => array('name' => 'DisplayOrder', 'type' => 'xsd:int'),
			    	'default' => array('name' => 'Default','type'=>'xsd:boolean'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestGroupDetails']=array(
				'LaboratoryTestGroupDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestGroupDetail[]')
		 		),
		 		'tns:LaboratoryTestGroupDetail',
		 		null
			);
			
		$types['LaboratoryPackage']=array(
			    'LaboratoryPackage',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'laboratory_id' => array('name' => 'LaboratoryId', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:string'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'validity_start_datetime' => array('name' => 'ValidityStartDatetime', 'type' => 'xsd:dateTime'),
			    	'validity_end_datetime' => array('name' => 'ValidityEndDatetime', 'type' => 'xsd:dateTime'),
			    	'price' => array('name' => 'Price','type'=>'xsd:decimal'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'packages' => array('name' => 'Packages', 'type' => 'xsd:string'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPackages']=array(
				'Packages',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPackage[]')
		 		),
		 		'tns:LaboratoryPackage',
		 		null
			);
			
		$types['LaboratoryPackageTestGroup']=array(
			    'LaboratoryPackageTestGroup',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'package_id' => array('name' => 'PackageId', 'type' => 'xsd:long'),
			    	'test_group_id' => array('name' => 'TestGroupId', 'type' => 'xsd:long'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPackageTestGroups']=array(
				'LaboratoryPackageTestGroups',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPackageTestGroup[]')
		 		),
		 		'tns:LaboratoryPackageTestGroup',
		 		null
			);
			
		$types['LaboratoryPackageDetail']=array(
			    'LaboratoryPackageDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'package_test_group_id' => array('name' => 'PackageTestGroupId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPackageDetails']=array(
				'LaboratoryPackageDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPackageDetail[]')
		 		),
		 		'tns:PackageDetail',
		 		null
			);
			
		$types['Discount']=array(
			    'Discount',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'discount' => array('name' => 'Discount','type'=>'xsd:decimal'),
			    	'enabled' => array('name' => 'Enabled','type'=>'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['Discounts']=array(
				'Discounts',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Discount[]')
		 		),
		 		'tns:Discount',
		 		null
			);
			
		$types['LaboratoryPatientOrder']=array(
			    'LaboratoryPatientOrder',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'laboratory_id' => array('name' => 'LaboratoryId', 'type' => 'xsd:long'),
			    	'company_branch_id' => array('name' => 'CompanyBranchId', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:string'),
			    	'patient_id' => array('name' => 'PatientId','type'=>'xsd:long'),
			    	'total_amount_due' => array('name' => 'TotalAmountDue','type'=>'xsd:decimal'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPatientOrders']=array(
				'LaboratoryPatientOrders',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPatientOrder[]')
		 		),
		 		'tns:LaboratoryPatientOrder',
		 		null
			);
			
			
		$types['LaboratoryPatientBatchOrder']=array(
			    'LaboratoryPatientBatchOrder',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_order_id' => array('name' => 'PatientOrderId', 'type' => 'xsd:long'),
			    	'batch_number' => array('name' => 'BatchNumber', 'type' => 'xsd:int'),
			    	'reference_number' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'total' => array('name' => 'Total','type'=>'xsd:decimal'),
			    	'vat' => array('name' => 'Vat','type'=>'xsd:decimal'),
			    	'vat_amount' => array('name' => 'VatAmount','type'=>'xsd:decimal'),
			    	'amount_due' => array('name' => 'AmountDue','type'=>'xsd:decimal'),
			    	'requested_date' => array('name' => 'RequestedDate','type'=>'xsd:string'),
			    	'requested_time' => array('name' => 'RequestedTime','type'=>'xsd:string'),
			    	'confirmed' => array('name' => 'Confirmed','type'=>'xsd:boolean'),
			    	'confirmed_date' => array('name' => 'ConfirmedDate','type'=>'xsd:string'),
			    	'confirmed_time' => array('name' => 'ConfirmedTime','type'=>'xsd:string'),
			    	'confirming_user_id' => array('name' => 'ConfirmingUserId','type'=>'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPatientBatchOrders']=array(
				'LaboratoryPatientBatchOrders',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPatientBatchOrder[]')
		 		),
		 		'tns:LaboratoryPatientBatchOrder',
		 		null
			);
			
		$types['LaboratoryPatientBatchOrderDiscount']=array(
			    'LaboratoryPatientBatchOrderDiscount',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_batch_order_id' => array('name' => 'PatientBatchOrderId', 'type' => 'xsd:long'),
			    	'discount_id' => array('name' => 'DiscountId', 'type' => 'xsd:long'),
			    	'discount' => array('name' => 'Discount','type'=>'xsd:decimal'),
			    	'amount' => array('name' => 'Amount','type'=>'xsd:decimal'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPatientBatchOrderDiscounts']=array(
				'LaboratoryPatientBatchOrderDiscounts',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPatientBatchOrderDiscount[]')
		 		),
		 		'tns:LaboratoryPatientBatchOrderDiscount',
		 		null
			);
			
		$types['LaboratoryPatientBatchOrderPackage']=array(
			    'LaboratoryPatientBatchOrderPackage',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_batch_order_id' => array('name' => 'PatientBatchOrderId', 'type' => 'xsd:long'),
			    	'package_id' => array('name' => 'PackageId', 'type' => 'xsd:long'),
			    	'test_group_id' => array('name' => 'TestGroupId', 'type' => 'xsd:long'),
			    	'test_group_price_id' => array('name' => 'TestGroupPriceId', 'type' => 'xsd:long'),
			    	'physician_id' => array('name' => 'PhysicianId', 'type' => 'xsd:long'),
			    	'company_branch_id' => array('name' => 'CompanyBranchId', 'type' => 'xsd:long'),
			    	'price' => array('name' => 'Price','type'=>'xsd:decimal'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPatientBatchOrderPackages']=array(
				'LaboratoryPatientBatchOrderPackages',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPatientBatchOrderPackage[]')
		 		),
		 		'tns:LaboratoryPatientBatchOrderPackage',
		 		null
			);
			
		$types['LaboratoryPatientBatchOrderDetail']=array(
			    'LaboratoryPatientBatchOrderDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_batch_order_package_id' => array('name' => 'PatientBatchOrderPackageId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'price' => array('name' => 'Price','type'=>'xsd:decimal'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryPatientBatchOrderDetails']=array(
				'LaboratoryPatientBatchOrderDetails',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryPatientBatchOrderDetail[]')
		 		),
		 		'tns:LaboratoryPatientBatchOrderDetail',
		 		null
			);
			
		$types['LaboratoryTestOrder']=array(
			    'LaboratoryTestOrder',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_order_id' => array('name' => 'PatientOrderId', 'type' => 'xsd:long'),
			    	'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'release_date' => array('name' => 'ReleaseDate','type'=>'xsd:string'),
			    	'release_time' => array('name' => 'ReleaseTime','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestOrders']=array(
				'LaboratoryTestOrders',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestOrder[]')
		 		),
		 		'tns:LaboratoryTestOrder',
		 		null
			);
			
		$types['LaboratoryTestOrderPackage']=array(
			    'LaboratoryTestOrderPackage',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'patient_batch_order_package_id' => array('name' => 'PatientBatchOrderPackageId', 'type' => 'xsd:long'),
			    	'test_order_id' => array('name' => 'TestOrderId', 'type' => 'xsd:long'),
			    	'test_group_id' => array('name' => 'TestGroupId', 'type' => 'xsd:long'),
			    	'supervisor_user_id' => array('name' => 'SupervisorUserId', 'type' => 'xsd:long'),
			    	'technologies_user_id' => array('name' => 'TechnologiesUserId', 'type' => 'xsd:long'),
			    	'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'release_date' => array('name' => 'ReleaseDate','type'=>'xsd:string'),
			    	'release_time' => array('name' => 'ReleaseTime','type'=>'xsd:string'),
			    	'remarks' => array('name' => 'Remarks','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
					'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestOrderPackages']=array(
				'LaboratoryTestOrderPackages',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestOrderPackage[]')
		 		),
		 		'tns:LaboratoryTestOrderPackage',
		 		null
			);
			
		$types['LaboratoryTestOrderResult']=array(
			    'LaboratoryTestOrderResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'test_order_package_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'test_id' => array('name' => 'TestId', 'type' => 'xsd:long'),
			    	'test_set_id' => array('name' => 'TestSetId', 'type' => 'xsd:long'),
			    	'value' => array('name' => 'Value', 'type' => 'xsd:string'),
			    	'unit' => array('name' => 'Unit', 'type' => 'xsd:string'),
			    	'si_value' => array('name' => 'SiValue', 'type' => 'xsd:string'),
			    	'si_unit' => array('name' => 'SiUnit', 'type' => 'xsd:string'),
			    	'si_reference_range' => array('name' => 'SiReferenceRange', 'type' => 'xsd:string'),
			    	'conventional_value' => array('name' => 'ConventionalValue', 'type' => 'xsd:string'),
			    	'conventional_unit' => array('name' => 'ConventionalUnit', 'type' => 'xsd:string'),
			    	'conventional_reference_range' => array('name' => 'ConventionalReferenceRange', 'type' => 'xsd:string'),
			    	'result_flag' => array('name' => 'ResultFlag', 'type' => 'xsd:string'),
			    	'status' => array('name' => 'status', 'type' => 'xsd:int'),
			    	'web_patient_viewable' => array('name' => 'WebPatientViewable', 'type' => 'xsd:boolean'),
			    	'web_physician_viewable' => array('name' => 'WebPhysicianViewable', 'type' => 'xsd:boolean'),
			    	'remarks' => array('name' => 'Remarks','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			);
			
		$types['LaboratoryTestOrderResults']=array(
				'LaboratoryTestOrderResults',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:LaboratoryTestOrderResult[]')
		 		),
		 		'tns:LaboratoryTestOrderResult',
		 		null
			);
		
		if ($complexName)
		{
			if (isset($types[$complexName]))
			{
				$type=$types[$complexName];
				$server->wsdl->addComplexType(
					$types[0],
				    $types[1],
				    $types[2],
				    $types[3],
				    $types[4],
				    $types[5],
				    $types[6],
				    $types[7],
				    $types[8]
				);
			}
		} else
		{
			foreach ($types as $key=>$type)
			{
				$server->wsdl->addComplexType(
					$type[0],
				    $type[1],
				    $type[2],
				    $type[3],
				    $type[4],
				    $type[5],
				    $type[6],
				    $type[7],
				    $type[8]
				);
			}
		}
		
		
		
	}
	
	function __validateKeys($key)
	{
		$fst = substr($key,0,4);
		$snd = substr($key,8,4);
		$trd = substr($key,16,4);
		$fth = substr($key,24,4);
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		CakeLog::write('debug', 'key');
		CakeLog::write('debug', $fst);
		CakeLog::write('debug', $snd);
		CakeLog::write('debug', $trd);
		CakeLog::write('debug', $fth);
		CakeLog::write('debug',md5($fst.$snd.$trd.$fth));
		CakeLog::write('debug',substr($key,32));
		CakeLog::write('debug', $checksum);
		
		
		if ($checksum==substr($key,32))
		{
			return true;
		}

			
		return false;
	}
	
	function __validateExecutionToken($executiontoken)
	{
		$session = $this->__getsession();
		
		//todo:save execution token
		
		if ($this->__validateToken($executiontoken['token']))
		{
			$datetime=substr(str_replace("T"," ",$executiontoken['datetime']),0,19);
			$eToken = LimSoap::__createToken(md5($session['accessToken']['token'].date("YmdHis",strtotime($datetime)).$executiontoken['random']));
	
			CakeLog::write('debug','test');

			CakeLog::write('debug',$executiontoken['token']);
			CakeLog::write('debug',$executiontoken['datetime']);
			CakeLog::write('debug',$executiontoken['random']);
			CakeLog::write('debug',$eToken);
			
			return ($executiontoken['token']==$eToken);
		}
		
		return false;
	}
	
	function __createDummyResultToken()
	{
		$now=date('c');
		$rand=rand().date('c');
		$md5=md5($rand);
		$token=sha1(rand().$rand);
		$result = array(
			'status'=>0,
			'datetime'=>$now,
			'random'=>$md5,
			'token'=>$token
		);
		
		return $result;
	}
	
	/*function __createFinalResultToken($executiontoken,$token,$status=1,$key,$return)
	{
		//$now=date('c');
		//$rand=rand().date('c');
		//$md5=md5($rand);
		//$token=substr(md5($md5).md5(rand()),11,40);
		
		//create time base on user timezone
		$now = date('c');
		$result['status']=$status;
		$result['datetime']=$now;
		$result['random']=md5(rand().$now);
		


		$datetime = LimSoap::__createTimeFromUserTimezone($executiontoken['datetime'],$now);
		
		CakeLog::write('debug','execution token');
		CakeLog::write('debug',$token.date("YmdHis",$datetime).$result['random']);
		//compute result token
		$result['token'] = LimSoap::__createToken(md5($token.date("YmdHis",$datetime).$result['random']),true);
		if ($return)
			return array('ResultToken'=>$result,"$key"=>$return);
		else
			return array('ResultToken'=>$result);
	}
	
	
	function __createResultToken($executiontoken,$status=0,$key=null,$return=null)
	{
		$session = $this->__getsession();
				
		//todo:save execution token
		
		if ($session) //must not be expired
		{
			return LimSoap:: __createFinalResultToken($executiontoken,$session['accessToken']['token'],$status,$key,$return);
		} else
		{
			//return null; //session expired
			return LimSoap:: __createFinalResultToken($executiontoken,$executiontoken['token'],100); //expired session
		}
		
	}*/

	function __computeDataChecksum($data)
	{
		
		/*foreach($data as $key=>$value)
		{
			if ($value)
		}*/
	}
	
	
	function __createFinalResultToken($executiontoken,$token,$status=1,$return)
	{
		//$now=date('c');
		//$rand=rand().date('c');
		//$md5=md5($rand);
		//$token=substr(md5($md5).md5(rand()),11,40);
		
		//create time base on user timezone
		$now = date('c');
		$result['status']=$status;
		$result['datetime']=$now;
		$result['random']=md5(rand().$now);
		


		$datetime = LimSoap::__createTimeFromUserTimezone($executiontoken['datetime'],$now);
		
		CakeLog::write('debug','execution token');
		CakeLog::write('debug',$token.date("YmdHis",$datetime).$result['random']);
		//compute result token
		$result['token'] = LimSoap::__createToken(md5($token.date("YmdHis",$datetime).$result['random']),true);
		
		$return['ResultToken']=$result;
		//debug($return);
		return $return;
	}
	
	
	function __createResultToken($executiontoken,$status=0,$return=null)
	{
		$session = $this->__getsession();
				
		//todo:save execution token
		
		if ($session) //must not be expired
		{
			return LimSoap:: __createFinalResultToken($executiontoken,$session['accessToken']['token'],$status,$return);
		} else
		{
			//return null; //session expired
			return LimSoap:: __createFinalResultToken($executiontoken,$executiontoken['token'],100,$return); //expired session
		}
		
	}
	
	function __createTimeFromUserTimezone($userdatetime,$datetime=null) //must be ISO 8601
	{
		/*if (!$datetime)
			$datetime=strtotime('now');
			
		$adjustmentindex=0;
		$adjustmentindex=strrpos($userdatetime,"+");
		
		if (!$adjustmentindex)
			$adjustmentindex=strrpos($userdatetime,"-");
		
		$retdatetime=null;
		if ($adjustmentindex)
		{
			$timeadjustment=substr($userdatetime,$adjustmentindex,3);
			CakeLog::write('debug',$timeadjustment);
			if ($timeadjustment != "+00" && $timeadjustment != "-00")
			{
				if ($timeadjustment != "+01" && $timeadjustment != "-01")
					$retdatetime=strtotime("$datetime $timeadjustment hours");
				else
					$retdatetime=strtotime("$datetime $timeadjustment hours");
			}
		}

		if (!$retdatetime)
			$retdatetime=strtotime('now');
		
		return $retdatetime;*/
		
		return strtotime('now');
	}
	
	function __validateToken($key)
	{
		$fst = substr($key,4,4);
		$snd = substr($key,12,4);
		$trd = substr($key,20,4);
		$fth = substr($key,28,4);
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		/*CakeLog::write('debug', 'token');
		CakeLog::write('debug', $fst);
		CakeLog::write('debug', $snd);
		CakeLog::write('debug', $trd);
		CakeLog::write('debug', $fth);
		CakeLog::write('debug',md5($fst.$snd.$trd.$fth));
		CakeLog::write('debug',substr($key,32));
		CakeLog::write('debug', $checksum);*/
		
		if ($checksum==substr($key,32))
		{
			return true;
		}

			
		return false;
	}
	
	function __generateAccessToken($username,$password,$execdatetime,$token)
	{
		/*$hash="";
		if (!$username && !$password && !$token)
			
		else
			$hash=md5($username.$password.$token);*/
		
		$now = date('c');
		$result['status']=1;
		$result['datetime']=$now;
		$result['random']=$hash=md5(rand().date("Y-m-d H:i:s").Configure::read('Security.salt'));;
		$datetime = LimSoap::__createTimeFromUserTimezone($execdatetime,$now);
		$result['token'] = LimSoap::__createToken(md5($token.date("YmdHis",$datetime).$result['random'].$password));
			
		return $result;
	}
	
	function __createToken($hash=null,$result=false)
	{
		
		if (!$hash)
			$hash=md5(rand().date("Y-m-d H:i:s:u").Configure::read('Security.salt'));
		
		if ($result)
		{
			$fst = substr($hash,4,6);
			$snd = substr($hash,12,6);
			$trd = substr($hash,20,6);
			$fth = substr($hash,28,4);
		}
		else {
			$fst = substr($hash,4,4);
			$snd = substr($hash,12,4);
			$trd = substr($hash,20,4);
			$fth = substr($hash,28,4);
		}
				
		$checksum=md5($fst.$snd.$trd.$fth);
		$checksum=substr($checksum,4,4).substr($checksum,20,4);
		
		return $hash.$checksum;
	}
	
	function __encryptPassword($token,$password,$base64=true)
	{
		$hash=substr($token,0,32);
		$checksum=substr($token,32);

		$hash=sha1(md5($hash).md5($checksum));

		$textpassword = $hash;
		//$password=base64_encode($password);
		for($i=0;$i<strlen($password);$i++)
		{
			$textpassword{$i} = $hash{$i} ^ $password{$i};
		}

		if ($base64)
			return base64_encode($textpassword);
		else
			return trim($textpassword);
	}
	
	function __decryptPassword($token,$password)
	{
		return $this->__encryptPassword($token,base64_decode($password),false);
	}
	
	function __getsession()
	{
		$session=CakeSession::read('webservice.session');
		
		//if (!$session && LimSoap::$debug && $_SERVER['REMOTE_ADDR'] == '127.0.0.1') //for debugging
		if (!$session && env('HTTP_USER_AGENT') == 'LimDebugClient')
		{
			$session['user']['id']=1;
			$session['accessToken']['token']='c8a309db758788cb4a3bfca317c78c4eea2fc8fb';
			//sample token
            //<token xsi:type="xsd:string">e97d7081b5e2e16fee4c2ca01172c619f3dec17d</token>
            //<random xsi:type="xsd:string">3e59cd7731214f7eb7db2510b7e81694</random>
            //<datetime xsi:type="xsd:dateTime">2013-01-18T01:55:44+08:00</datetime>
			
		}
		
		CakeLog::write('debug','accessToken');
		CakeLog::write('debug',$session['accessToken']['token']);
		
		return $session;
	}
	
	function __createsession($user, $accessToken)
	{
		CakeSession::write('webservice.session',array('user'=>$user,'accessToken'=>$accessToken));
		return true;
	}
	
	function __destroysession()
	{
		CakeSession::delete('webservice.session');
		return true;
	}
	
	
	function __computechecksum(&$data)
	{
		$sdata="";
		foreach($data as $key=>$value)
		{
			if ($value)
			{
				if (strpos($key,"date") >= 0)
				{
					$date = date("M/d/Y H:i:s",strtotime($value));
					$sdata = $date;
				} else
					$sdata.=$value;
			}
		}
		
		if ($sdata)
		{
			$data['checksum']=md5($sdata);
			//debug($data);
			return $data;
		}
		else
			return $data;
	}
}


/*
 *
static $types1  = array(

			'AccessToken' => array(
				'AccessToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'result' => array('name' => 'Result', 'type' => 'xsd:int'),
			    	'token' => array('name' => 'Token', 'type' => 'xsd:string')
			    ),
			    null,
			    null,
			    null
			),
			'ExecutionToken' =>array(
				'ExecutionToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'token' => array('name' => 'token', 'type' => 'xsd:string'),
			    	'random' => array('name' => 'random', 'type' => 'xsd:string'),
			    	'datetime' => array('name' => 'datetime', 'type' => 'xsd:dateTime')
			    ),
			    null,
			    null,
			    null
			),
			'ResultToken'=>array(
				'ResultToken',
			    'complexType',
			    'struct',
			    'all',
			    '',
			    array(
			    	'status' => array('name' => 'status', 'type' => 'xsd:int'), //0 - fail //1 - success
			    	'token' => array('name' => 'token', 'type' => 'xsd:string'),
			    	'random' => array('name' => 'random', 'type' => 'xsd:string'),
			    	'datetime' => array('name' => 'datetime', 'type' => 'xsd:dateTime')
			    ),
			    null,
			    null,
			    null
			),
			'Address'=>array(
			    'Address',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'floor' => array('name' => 'Floor', 'type' => 'xsd:string'),
			    	'unit' => array('name' => 'Unit', 'type' => 'xsd:string'),
			    	'building_apartment' => array('name' => 'BuildingApartment', 'type' => 'xsd:string'),
			    	'street_number' => array('name' => 'StreetNumber','type'=>'xsd:string'),
			    	'street_id' => array('name' => 'StreetId','type'=>'xsd:long'),
			    	'village_id' => array('name' => 'VillageId','type'=>'xsd:long'),
			    	'town_city_id' => array('name' => 'TownCityId','type'=>'xsd:long'),
			    	'province_state_id' => array('name' => 'ProvinceStateId','type'=>'xsd:long'),
			    	'country_id' => array('name' => 'CountryId','type'=>'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'Addresses'=>array(
				'Addresses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Address[]')
		 		),
		 		'tns:Address',
		 		null
			),
			'ContactInformation'=>array(
			    'ContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'type' => array('name' => 'Floor', 'type' => 'xsd:int'),
			    	'contact' => array('name' => 'Contact', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'ContactInformations'=>array(
				'ContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:ContactInformation[]')
		 		),
		 		'tns:ContactInformation',
		 		null
			),
			'IdentificationType'=>array(
			    'IdentificationType',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'internal_id' => array('name' => 'InternalId', 'type' => 'xsd:long'),
			    	'name' => array('name' => 'Name', 'type' => 'xsd:string'),
			    	'text' => array('name' => 'Text', 'type' => 'xsd:string'),
			    	'description' => array('name' => 'Description', 'type' => 'xsd:string'),
			    	'type' => array('name' => 'StreetNumber','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'IdentificationTypes'=>array(
				'IdentificationTypes',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:IdentificationType[]')
		 		),
		 		'tns:IdentificationType',
		 		null
			),
			'User'=>array(
				'User',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'username' => array('name' => 'Username', 'type' => 'xsd:string'),
			    	'role' => array('name' => 'Role', 'type' => 'xsd:int'),
			    	'status' => array('name' => 'Status', 'type' => 'xsd:int'),
			    	//'PersonIdentity' => array('type'=>'tns:PersonIdentities'),
			    ),
			    null,
			    null,
			    null
			),
			'Person'=>array(
				'Person',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'title_id' => array('name' => 'TitleId', 'type' => 'xsd:long'),
			    	'lastname' => array('name' => 'Lastname', 'type' => 'xsd:string'),
			    	'firstname' => array('name' => 'Firstname', 'type' => 'xsd:string'),
			    	'middlename' => array('name' => 'Middlename', 'type' => 'xsd:string'),
			    	'maidenname' => array('name' => 'Maidenname', 'type' => 'xsd:string'),
			    	'suffix_id' => array('name' => 'SuffixId', 'type' => 'xsd:long'),
			    	'birthdate' => array('name' => 'Birthdate', 'type' => 'xsd:date'),
			    	'sex' => array('name' => 'Sex', 'type' => 'xsd:string'),
			    	'marital_status' => array('name' => 'MaritalStatus', 'type' => 'xsd:string'),
			    	'father_person_id' => array('name' => 'FatherPersonId', 'type' => 'xsd:long'),
			    	'mother_person_id' => array('name' => 'MotherPersonId', 'type' => 'xsd:long'),
			    	'living_status' => array('name' => 'LivingStatus', 'type' => 'xsd:int'),
			    	'record_status' => array('name' => 'RecordStatus', 'type' => 'xsd:int'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'validated' => array('name' => 'Validated', 'type' => 'xsd:boolean'),
			    	'validated_datetime' => array('name' => 'ValidatedDatetime', 'type' => 'xsd:dateTime'),
			    	'validating_user_id' => array('name' => 'ValidatingUserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonAddress'=>array(
			    'PersonAddress',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'Address' => array('name' => 'Address', 'type' => 'tns:Address'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonAddresses'=>array(
				'PersonAddresses',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonAddress[]')
		 		),
		 		'tns:PersonAddress',
		 		null
			),
			'PersonAlias'=>array(
			    'PersonAlias',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'PersonAlias' => array('name' => 'PersonAlias', 'type' => 'tns:Person'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonAliases'=>array(
				'PersonAliases',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonAlias[]')
		 		),
		 		'tns:PersonAlias',
		 		null
			),
			'PersonContactInformation'=>array(
			    'PersonContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name'=>'Person','type'=>'tns:Person'),
			    	'ContactInformation' => array('name'=>'ContactInformation','type'=>'tns:ContactInformation'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	
			    ),
			    null,
			    null,
			    null
			),
			'PersonContactInformations'=>array(
				'PersonContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonContactInformation[]')
		 		),
		 		'tns:PersonContactInformation',
		 		null
			),
			'PersonIdentity'=>array(
			    'PersonIdentity',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'User' => array('name' => 'User', 'type' => 'tns:User'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'default' => array('name' => 'Default', 'type' => 'xsd:boolean'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonIdentities'=>array(
				'PersonIdentities',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonIdentity[]')
		 		),
		 		'tns:PersonIdentity',
		 		null
			),
			'PersonIdentification'=>array(
			    'PersonIdentification',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    	'IdentificationType' => array('name' => 'IdentificationType', 'type' => 'tns:IdentificationType'),
			    	'reference_number' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'remarks' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'image' => array('name' => 'ReferenceNumber', 'type' => 'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonIdentifications'=>array(
				'PersonIdentifications',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonIdentification[]')
		 		),
		 		'tns:PersonIdentification',
		 		null
			),
			'PersonInsurance'=>array(
			    'PersonInsurance',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'insurance_provider_product_id' => array('name'=>'InsuranceProviderProductId','type'=>'xsd:long'),
			    	'effectivity_date' => array('name'=>'EffectivityDate','type'=>'xsd:dateTime'),
			    	'expiration_date' => array('name'=>'ExpirationDate','type'=>'xsd:dateTime'),
			    	'limit_details' => array('name'=>'LimitDetails','type'=>'xsd:string'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonInsurances'=>array(
				'PersonInsurances',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonInsurance[]')
		 		),
		 		'tns:PersonInsurance',
		 		null
			),
			'PersonContactInformation'=>array(
			    'PersonContactInformation',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'Person' => array('name'=>'Person','type'=>'tns:Person'),
			    	'ContactInformation' => array('name'=>'ContactInformation','type'=>'tns:ContactInformation'),
			    	'entry_datetime' => array('name' => 'EntryDatetime', 'type' => 'xsd:dateTime'),
			    	'user_id' => array('name' => 'UserId', 'type' => 'xsd:long'),
			    	'posted' => array('name' => 'Posted', 'type' => 'xsd:boolean'),
			    	'posted_datetime' => array('name' => 'PostedDatetime', 'type' => 'xsd:dateTime'),
			    	
			    ),
			    null,
			    null,
			    null
			),
			'PersonContactInformations'=>array(
				'PersonContactInformations',
				'complexType',
				'array',
				'sequence',
				'SOAP-ENC:Array',
		  		array(),
		  		array(
		    		array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:PersonContactInformation[]')
		 		),
		 		'tns:PersonContactInformation',
		 		null
			),
			'PersonDetail'=>array(
			    'PersonDetail',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'PersonAddress' => array('name'=>'person_addresses','type'=>'tns:PersonAddresses'),
			    	'PersonAlias' => array('name'=>'person_aliases','type'=>'tns:PersonAliases'),
			    	'PersonContactInformation' => array('name'=>'person_contact_informations','type'=>'tns:PersonContactInformations'),
			    	'PersonIdentification' => array('name'=>'person_identifications','type'=>'tns:PersonIdentifications'),
			    	'PersonInsurance' => array('name'=>'person_insurances','type'=>'tns:PersonInsurances'),
			    ),
			    null,
			    null,
			    null
			),
						
			'UserIdentities'=>array(
				'UserIdentities',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'id' => array('name' => 'Id', 'type' => 'xsd:long'),
			    	'PersonIdentity' => array('type'=>'tns:PersonIdentities'),
			    ),
			    null,
			    null,
			    null
			),
		
			'UserResult'=>array(
			    'UserResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'User' => array('name' => 'User', 'type' => 'tns:User'),
			    ),
			    null,
			    null,
			    null
			),
			'UserIdentitiesResult'=>array(
			    'UserIdentitiesResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'UserIdentities' => array('name' => 'User', 'type' => 'tns:UserIdentities'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonResult'=>array(
			    'PersonResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'Person' => array('name' => 'Person', 'type' => 'tns:Person'),
			    ),
			    null,
			    null,
			    null
			),
			'PersonDetailResult'=>array(
			    'PersonDetailResult',
			    'complexType',
			    'struct',
			    'sequence',
			    '',
			    array(
			    	'ResultToken' => array('name' => 'ResultToken', 'type' => 'tns:ResultToken'),
			    	'PersonDetail' => array('name' => 'PersonDetail', 'type' => 'tns:PersonDetail'),
			    ),
			    null,
			    null,
			    null
			),
						
		);
		
		*/
 