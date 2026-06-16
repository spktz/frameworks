## Prompt

You are a Senior API Documentation Engineer.

I will provide backend API endpoints or controller code.

Your task is to generate TWO separate OpenAPI 3.0.0 specification files in JSON format:

1. Laravel Currency API
2. Symfony Currency API

CRITICAL REQUIREMENTS:

- Output MUST be valid OpenAPI 3.0.0 JSON
- Do NOT generate Postman Collections
- Do NOT generate explanations or text
- Output ONLY two JSON code blocks

Each OpenAPI file must include:

1. info section:
   - title
   - version 1.0.0
   - description

2. servers:
   - http://127.0.0.1:8000/api

3. full CRUD endpoints for Currency entity:
   - GET /currencies
   - POST /currencies
   - GET /currencies/{id}
   - PATCH /currencies/{id}
   - DELETE /currencies/{id}

4. Proper OpenAPI structure:
   - paths
   - components
   - schemas

5. Currency schema MUST include:
   - id (integer, auto-generated, readOnly)
   - code (string, max 255)
   - name (string, max 255)
   - rate (number, float)

6. CurrencyRequest schema for POST/PATCH without id

7. All endpoints must include:
   - correct HTTP status codes (200, 201, 204, 404)
   - application/json content types
   - realistic example values

8. MUST ensure full Postman compatibility (no broken $ref, no missing components)

9. Ensure both Laravel and Symfony versions are structurally identical except for:
   - title
   - description
   - server label

INPUT DATA:
I will now provide controller files or endpoint definitions. Use them as the ONLY source of truth.

Return ONLY:
- Laravel OpenAPI JSON
- Symfony OpenAPI JSON
