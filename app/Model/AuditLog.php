<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property User $User
 * @property Post $Post
 * @property Tag $Tag
 */
class AuditLog extends AppModel {
	var $name = 'AuditLog';
	var $displayField = 'id';
}
