# Changelog

## [3.0.0] - 2025-03-11
### Added
- **PHPStan Compliant Developer Comments**: Added detailed PHPStan-compliant comments to improve code readability and maintainability.
- **`collection()` Method**: Introduced a new method to centralize response data collection, reducing redundancy in `json()` and `array()`.
- **Static Response Key Names**: Defined `$result_key_text`, `$error_key_text`, and `$input_key_text` as static class properties for better maintainability.

### Changed
- **Singleton Handling**: Improved `singleton()` method for better reusability instead of initializing in multiple places.
- **Constructor Reset Behavior**: Adjusted constructor logic to ensure that each instantiation resets response states correctly.
- **JSON Parsing Validation**: Enhanced JSON request body parsing by verifying `json_last_error()`.
- **Better Result & Error Storage**: Updated result and error storage to always ensure correct structuring when using keys.

### Fixed
- **Incorrect Singleton Reinitialization**: Ensured `singleton()` and `init()` methods correctly maintain a single instance.
- **Input Handling Edge Cases**: Addressed cases where JSON input merging could fail under certain request formats.
- **Return Consistency**: Standardized method return values to always return `self` where applicable for method chaining.

---

## [2.0.1] - Previous Version
### Initial Features
- Implemented Singleton pattern.
- Added methods for storing results (`result()`) and errors (`error()`).
- Supported response output in both JSON (`json()`) and array (`array()`) formats.
- Allowed toggling of user input inclusion in responses via `input()` method.

