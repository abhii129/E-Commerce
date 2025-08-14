@extends('layouts.admin')

@section('content')
    <div class="admin-container">
        <div class="attributes-header">
            <div class="header-content">
                <h1 class="page-title">Product Attributes</h1>
                <p class="page-subtitle">Manage product characteristics and specifications</p>
            </div>
            <a href="{{ route('admin.product-attributes.create') }}" class="btn-primary">
                <span>Add New Attribute</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </a>
        </div>

        <div class="modern-table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Type</th>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                        <tr>
                            <td data-label="Name">
                                <div class="cell-content">{{ $attribute->name }}</div>
                            </td>
                            <td data-label="Category">
                                <div class="cell-content">{{ $attribute->category->name }}</div>
                            </td>
                            <td data-label="Subcategory">
                                <div class="cell-content">{{ $attribute->subcategory->name }}</div>
                            </td>
                            <td data-label="Type">
                                <div class="cell-content">
                                    <span class="badge {{ $attribute->type === 'select' ? 'badge-blue' : 'badge-gray' }}">
                                        {{ $attribute->type }}
                                    </span>
                                </div>
                            </td>
                            <td data-label="Options">
                                <div class="cell-content">
                                    @if($attribute->options)
                                        {{ implode(', ', json_decode($attribute->options)) }}
                                    @else
                                        <span class="text-muted">No options</span>
                                    @endif
                                </div>
                            </td>
                            <td data-label="Actions">
                                <div class="actions-cell">
                                    <a href="{{ route('admin.product-attributes.edit', $attribute->id) }}" class="btn-icon" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.product-attributes.destroy', $attribute->id) }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon danger" title="Delete" onclick="return confirm('Are you sure you want to delete this attribute?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .attributes-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-content {
            flex: 1;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
            color: #212529;
        }

        .page-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0.25rem 0 0;
        }

        .modern-table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9375rem;
        }

        .modern-table thead {
            background-color: #f8f9fa;
            border-bottom: 1px solid var(--border-color);
        }

        .modern-table th {
            padding: 1rem 1.25rem;
            text-align: left;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .modern-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .modern-table tr:last-child td {
            border-bottom: none;
        }

        .modern-table tr:hover {
            background-color: #f8fafc;
        }

        .cell-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-blue {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .badge-gray {
            background-color: rgba(108, 117, 125, 0.1);
            color: var(--text-muted);
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-muted);
        }

        .btn-icon:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--primary);
        }

        .btn-icon.danger:hover {
            background-color: rgba(239, 35, 60, 0.1);
            color: var(--error);
        }

        .btn-icon svg {
            width: 16px;
            height: 16px;
        }

        .inline-form {
            display: inline;
            margin: 0;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .modern-table {
                display: block;
            }
            
            .modern-table thead {
                display: none;
            }
            
            .modern-table tr {
                display: block;
                padding: 1rem;
                border-bottom: 1px solid var(--border-color);
            }
            
            .modern-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0;
                border-bottom: none;
            }
            
            .modern-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--text-muted);
                margin-right: 1rem;
                flex: 1;
            }
            
            .modern-table td .cell-content {
                flex: 2;
                justify-content: flex-end;
            }
            
            .actions-cell {
                justify-content: flex-end;
            }
        }
    </style>
@endsection