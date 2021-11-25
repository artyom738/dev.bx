<?php

use PHPUnit\Framework\TestCase;

class FinancialTransactionsRuTest extends TestCase
{
	public function getValidateFailEmptySamples(): array
	{
		return [
			'empty' => [
				[],
			],
			'filled but empty' => [
				[
					'Name' => '',
					'PersonalAcc' => '',
					'BankName' => '',
					'BIC' => '',
					'CorrespAcc' => '',
				],
			],
			'filled but empty name' => [
				[
					'Name' => '',
					'PersonalAcc' => 'PersonalAcc',
					'BankName' => 'BankName',
					'BIC' => 'BIC',
					'CorrespAcc' => 'CorrespAcc',
				],
			],
			'filled but empty BankName' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => 'PersonalAcc',
					'BankName' => '',
					'BIC' => 'BIC',
					'CorrespAcc' => 'CorrespAcc',
				],
			],
			'filled but empty two fields' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => '',
					'BankName' => 'BankName',
					'BIC' => 'BIC',
					'CorrespAcc' => '',
				],
			],

		];
	}

	public function getValidateFailLongValuesSamples(): array
	{
		return [
			'filled but with all too long fields' => [
				[
					'Name' => 'NameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePersonNameOfThePerson',
					'PersonalAcc' => '12345678912345678978987',
					'BankName' => 'SberbankVTBTinkoffSberbankVTBTinkoffSberbankVTBTinkoff',
					'BIC' => 'SberbankVTBTinkoff',
					'CorrespAcc' => 'CorrespondentAccountOfTheUser',
				],
			],
			'filled but with two too long fields' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => '12345678912345678978987',
					'BankName' => 'Sber',
					'BIC' => 'SberbankVTBTinkoff',
					'CorrespAcc' => 'CorrAccount',
				],
			],
		];
	}

	public function getValidateSuccessSamples(): array
	{
		return [
			'filled' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => 'PersonalAcc',
					'BankName' => 'BankName',
					'BIC' => 'BIC',
					'CorrespAcc' => 'CorrespAcc',
				],
			],
		];
	}

	/**
	 * @dataProvider getValidateFailEmptySamples
	 *
	 * @param array $fields
	 */
	public function testValidateFail(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();

		static::assertFalse($result->isSuccess());
	}

	/**
	 * @dataProvider getValidateFailEmptySamples
	 *
	 * @param array $fields
	 */
	public function testValidateFailWithErrorMessageEmptyField(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();
		$errors = $result->getErrorMessages();

		static::assertFalse($result->isSuccess());

		foreach (array_keys($fields) as $field)
		{
			if ($fields[$field] === '')
			{
				static::assertContains("Mandatory field {$field} is not filled", $errors);
			}
		}
	}

	/**
	 * @dataProvider getValidateFailLongValuesSamples
	 *
	 * @param array $fields
	 */
	public function testThatValidateFailsWithTooLongFields(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();
		$errors = $result->getErrorMessages();

		static::assertFalse($result->isSuccess());

		foreach (array_keys($fields) as $field)
		{
			if (strlen($fields[$field]) > $dataGenerator->getFieldValueMaximumLength($field))
			{
				static::assertContains("The value of {$field} is too long", $errors);
			}
		}
	}

	/**
	 * @dataProvider getValidateSuccessSamples
	 *
	 * @param array $fields
	 */
	public function testThatValidateSuccess(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();

		static::assertTrue($result->isSuccess());
	}

	public function testGetData(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$data = $dataGenerator->getData();

		static::assertEquals('ST00012|Name=|PersonalAcc=|BankName=|BIC=|CorrespAcc=', $data);
	}
}
