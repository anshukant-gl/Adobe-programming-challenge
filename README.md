# Unique Leads Filter

This script processes a `leads.json` file and generates an output file `unique_leads.json` containing only unique leads. A lead is considered unique if both its `_id` and `email` are not duplicated in the dataset.

## Input

- `leads.json`: A JSON file containing an array of lead objects.
  Each lead is expected to have at least the following fields:
  - `_id`
  - `email`
  - `entryDate`

## Output

- `unique_leads.json`: A JSON file containing only the unique leads based on `_id` and `email`.

## Run 

- execute 'php run.php' command from cli

## 📦 Installation

Clone the repository and install dependencies if needed:

```bash
git clone https://github.com/anshukant-gl/Adobe-programming-challenge.git
