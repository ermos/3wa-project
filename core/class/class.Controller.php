<?php
namespace core;

abstract class Controller {

	abstract public function api(): void;

    abstract public function run(): void;

}