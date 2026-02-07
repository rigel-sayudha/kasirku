# Replace known secrets with a safe placeholder across files in working tree
$replacements = @{
    'REDACTED_OPENAI_KEY' = 'REDACTED_OPENAI_KEY'
    'REDACTED_OPENAI_KEY' = 'REDACTED_OPENAI_KEY'
}

Get-ChildItem -Recurse -File | ForEach-Object {
    $path = $_.FullName
    try {
        $content = Get-Content -Raw -Encoding UTF8 $path -ErrorAction Stop
    } catch {
        return
    }
    $modified = $false
    foreach ($old in $replacements.Keys) {
        if ($content -like "*$old*") {
            $content = $content -replace [regex]::Escape($old), $replacements[$old]
            $modified = $true
        }
    }
    if ($modified) { Set-Content -Encoding UTF8 -Value $content $path }
}

